<?php

namespace App\Livewire\Dashboard;

use App\Models\OtpToken;
use App\Models\User;
use App\Models\Withdrawal;
use App\Notifications\TokenRequested;
use App\Notifications\TransactionOccured;
use App\Notifications\WithdrawalInitiated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.app')]
class VerifyOtp extends Component
{
  #[Url]
  public int $amount = 0;

  #[Url]
  public string $method = '';

  #[Url]
  public string $address = '';

  public string $token = '';

  private ?OtpToken $generatedToken = null;

  private const AMOUNT_MULTIPLIER = 100;
  private const OTP_LENGTH = 6;
  private const OTP_EXPIRY_MINUTES = 10;

  public function mount(): void
  {
    $this->generatedToken = OtpToken::where('user_id', auth()->id())->first();

    if (!$this->generatedToken) {
      session()->flash('error', 'No OTP token found. Please request a new one.');
      $this->redirectRoute('dashboard.withdraw');
    }
  }

  public function createWithdrawal(): void
  {
    try {
      $this->validateWithdrawalRequest();

      DB::transaction(function () {
        // Lock the OTP token to prevent concurrent usage
        $otpToken = OtpToken::where('user_id', auth()->id())
          ->lockForUpdate()
          ->first();

        if (!$otpToken) {
          throw new \RuntimeException('OTP token not found');
        }

        // Verify token hasn't been used (if you track usage)
        $this->verifyOtpToken($otpToken);

        // Lock user record to prevent race conditions on balance
        $user = User::where('id', auth()->id())
          ->lockForUpdate()
          ->first();

        if (!$user) {
          throw new \RuntimeException('User not found');
        }

        // Verify user has sufficient balance
        $this->verifyUserBalance($user);

        // Create withdrawal record
        $withdrawal = Withdrawal::create([
          'user_id' => $user->id,
          'amount' => $this->amount,
          'payment_method' => $this->method,
          'address' => $this->address,
          'status' => 'pending'
        ]);

        // Optionally delete or mark OTP as used to prevent reuse
        $otpToken->delete();

        // Send notifications outside transaction to avoid blocking
        $this->sendWithdrawalNotifications($user, $withdrawal);
      });

      session()->flash('message', 'Withdrawal successful. You will receive an email when your withdrawal has been processed.');
      $this->redirectRoute('dashboard.withdrawhistory');
    } catch (\RuntimeException $e) {
      $this->dispatch('withdraw-error', message: $e->getMessage())->self();
    } catch (\Exception $e) {
      Log::error('Withdrawal creation failed', [
        'user_id' => auth()->id(),
        'amount' => $this->amount,
        'error' => $e->getMessage()
      ]);
      $this->dispatch('withdraw-error', message: 'Failed to process withdrawal. Please try again.')->self();
    }
  }

  private function validateWithdrawalRequest(): void
  {
    if (empty($this->token)) {
      throw new \RuntimeException('OTP token field is empty');
    }

    if ($this->amount <= 0) {
      throw new \RuntimeException('Invalid withdrawal amount');
    }

    if (empty($this->method) || empty($this->address)) {
      throw new \RuntimeException('Invalid withdrawal details');
    }
  }

  private function verifyOtpToken(OtpToken $otpToken): void
  {
    // Constant-time comparison to prevent timing attacks
    if (!hash_equals($otpToken->token, $this->token)) {
      throw new \RuntimeException('Invalid OTP token');
    }

    $now = now()->getTimestampMs();
    if ($now > $otpToken->expires_at) {
      throw new \RuntimeException('Expired OTP token. Click on "Resend code" to generate a new token.');
    }
  }

  private function verifyUserBalance(User $user): void
  {
    // Assuming withdrawals come from live balance
    $balance = $user->live_balance ?? 0;

    if ($balance < $this->amount) {
      throw new \RuntimeException('Insufficient balance for withdrawal');
    }
  }

  private function sendWithdrawalNotifications(User $user, Withdrawal $withdrawal): void
  {
    // Queue notifications to avoid blocking the transaction
    $normalizedAmount = $this->normalizeAmount($this->amount);

    dispatch(function () use ($user, $normalizedAmount) {
      $user->notify(new WithdrawalInitiated($user->name, strval($normalizedAmount)));
    })->afterResponse();

    dispatch(function () use ($user, $normalizedAmount) {
      $admin = User::where('is_admin', 1)->first();
      if ($admin) {
        $admin->notify(new TransactionOccured('withdrawal', $user->name, strval($normalizedAmount)));
      }
    })->afterResponse();
  }

  private function normalizeAmount(int $amount): float
  {
    return $amount / self::AMOUNT_MULTIPLIER;
  }

  public function resendOTPToken(): void
  {
    try {
      DB::transaction(function () {
        // Lock to prevent multiple simultaneous token generations
        $existingToken = OtpToken::where('user_id', auth()->id())
          ->lockForUpdate()
          ->first();

        // Rate limiting check - prevent token spam
        if ($existingToken && $existingToken->created_at->gt(now()->subMinute())) {
          throw new \RuntimeException('Please wait before requesting a new token');
        }

        $newToken = $this->generateSecureOtpToken();

        $token = OtpToken::updateOrCreate(
          ['user_id' => auth()->id()],
          [
            'token' => $newToken,
            'expires_at' => now()->addMinutes(self::OTP_EXPIRY_MINUTES)->getTimestampMs()
          ]
        );

        $this->generatedToken = $token;

        // Send notification after transaction
        $this->sendOtpNotification($token->token);
      });

      $this->dispatch('token-generated', message: 'A new code has been sent to your email address')->self();
    } catch (\RuntimeException $e) {
      $this->dispatch('withdraw-error', message: $e->getMessage())->self();
    } catch (\Exception $e) {
      Log::error('OTP token generation failed', [
        'user_id' => auth()->id(),
        'error' => $e->getMessage()
      ]);
      $this->dispatch('withdraw-error', message: 'Failed to generate OTP token. Please try again.')->self();
    }
  }

  private function generateSecureOtpToken(): string
  {
    // More secure random number generation
    return str_pad(
      (string) random_int(0, 999999),
      self::OTP_LENGTH,
      '0',
      STR_PAD_LEFT
    );
  }

  private function sendOtpNotification(string $token): void
  {
    dispatch(function () use ($token) {
      $user = User::find(auth()->id());
      if ($user) {
        $user->notify(new TokenRequested($user->name, $token));
      }
    })->afterResponse();
  }

  public function render()
  {
    return view('livewire.dashboard.verify-otp');
  }
}
