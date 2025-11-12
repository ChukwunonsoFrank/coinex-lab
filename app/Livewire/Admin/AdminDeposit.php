<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Deposit;
use Livewire\Component;
use App\Models\Referral;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use App\Notifications\DepositApproved;
use App\Notifications\DepositDeclined;
use App\Notifications\CommissionEarned;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin')]

class AdminDeposit extends Component
{
  public $firstUpline;

  public $secondUpline;

  public $thirdUpline;

  public int $level = 0;

  public function getStatusIndicatorColor(string $status)
  {
    if ($status === 'pending') {
      return 'bg-warning-50 text-warning-600';
    }

    if ($status === 'approved') {
      return 'bg-success-50 text-success-600';
    }

    if ($status === 'declined') {
      return 'bg-error-50 text-error-600';
    }
  }

  public function computeUpline(string $referredBy)
  {
    // Reset properties
    $this->firstUpline = null;
    $this->secondUpline = null;
    $this->thirdUpline = null;
    $this->level = 0;

    $currentUpline = User::where('referral_code', $referredBy)->first();
    if ($currentUpline !== null) {
      $this->firstUpline = $currentUpline;
      $this->level += 1;
      $currentUpline = User::where('referral_code', $currentUpline['referred_by'])->first();
      if ($currentUpline !== null) {
        $this->secondUpline = $this->firstUpline;
        $this->firstUpline = $currentUpline;
        $this->level += 1;
        $currentUpline = User::where('referral_code', $currentUpline['referred_by'])->first();
        if ($currentUpline !== null) {
          $this->thirdUpline = $this->secondUpline;
          $this->secondUpline = $this->firstUpline;
          $this->firstUpline = $currentUpline;
          $this->level += 1;
        }
      }
    }
  }

  public function processReferralPayouts(float $depositAmount, string $referralCode, string $depositOwnerName)
  {
    if ($this->level === 1) {
      $this->payoutLevel1($depositAmount, $referralCode, $depositOwnerName);
    }

    if ($this->level === 2) {
      $this->payoutLevel2($depositAmount, $referralCode, $depositOwnerName);
    }

    if ($this->level === 3) {
      $this->payoutLevel3($depositAmount, $referralCode, $depositOwnerName);
    }
  }

  private function payoutLevel1(float $depositAmount, string $referralCode, string $depositOwnerName)
  {
    $commission = round(0.05 * floatval($depositAmount), 2);

    // Lock the user row for update to prevent race conditions
    $firstUpline = User::where('id', $this->firstUpline['id'])->lockForUpdate()->first();
    $newFirstUplineBalance = (($firstUpline->live_balance / 100) + $commission) * 100;

    $firstUpline->update(['live_balance' => $newFirstUplineBalance]);

    Referral::create([
      'user_id' => $firstUpline->id,
      'referral_code' => $referralCode,
      'amount' => $commission * 100,
      'level' => '1'
    ]);

    $firstUpline->notify(new CommissionEarned($firstUpline->name, $depositOwnerName, strval($commission)));
  }

  private function payoutLevel2(float $depositAmount, string $referralCode, string $depositOwnerName)
  {
    // Lock both user rows for update
    $secondUpline = User::where('id', $this->secondUpline['id'])->lockForUpdate()->first();
    $firstUpline = User::where('id', $this->firstUpline['id'])->lockForUpdate()->first();

    // Middle upline commission (5%)
    $commission = round(0.05 * floatval($depositAmount), 2);
    $newSecondUplineBalance = (($secondUpline->live_balance / 100) + $commission) * 100;

    $secondUpline->update(['live_balance' => $newSecondUplineBalance]);

    Referral::create([
      'user_id' => $secondUpline->id,
      'referral_code' => $referralCode,
      'amount' => $commission * 100,
      'level' => '1'
    ]);

    $secondUpline->notify(new CommissionEarned($secondUpline->name, $depositOwnerName, strval($commission)));

    // First upline commission (2%)
    $commission = round(0.02 * floatval($depositAmount), 2);
    $newFirstUplineBalance = (($firstUpline->live_balance / 100) + $commission) * 100;

    $firstUpline->update(['live_balance' => $newFirstUplineBalance]);

    Referral::create([
      'user_id' => $firstUpline->id,
      'referral_code' => $referralCode,
      'amount' => $commission * 100,
      'level' => '2'
    ]);

    $firstUpline->notify(new CommissionEarned($firstUpline->name, $depositOwnerName, strval($commission)));
  }

  private function payoutLevel3(float $depositAmount, string $referralCode, string $depositOwnerName)
  {
    // Lock all three user rows for update
    $firstUpline = User::where('id', $this->firstUpline['id'])->lockForUpdate()->first();
    $secondUpline = User::where('id', $this->secondUpline['id'])->lockForUpdate()->first();
    $thirdUpline = User::where('id', $this->thirdUpline['id'])->lockForUpdate()->first();

    // Top upline commission (1%)
    $commission = round(0.01 * floatval($depositAmount), 2);
    $newFirstUplineBalance = (($firstUpline->live_balance / 100) + $commission) * 100;

    $firstUpline->update(['live_balance' => $newFirstUplineBalance]);

    Referral::create([
      'user_id' => $firstUpline->id,
      'referral_code' => $referralCode,
      'amount' => $commission * 100,
      'level' => '3'
    ]);

    $firstUpline->notify(new CommissionEarned($firstUpline->name, $depositOwnerName, strval($commission)));

    // Middle upline commission (2%)
    $commission = round(0.02 * floatval($depositAmount), 2);
    $newSecondUplineBalance = (($secondUpline->live_balance / 100) + $commission) * 100;

    $secondUpline->update(['live_balance' => $newSecondUplineBalance]);

    Referral::create([
      'user_id' => $secondUpline->id,
      'referral_code' => $referralCode,
      'amount' => $commission * 100,
      'level' => '2'
    ]);

    $secondUpline->notify(new CommissionEarned($secondUpline->name, $depositOwnerName, strval($commission)));

    // Last upline commission (5%)
    $commission = round(0.05 * floatval($depositAmount), 2);
    $newThirdUplineBalance = (($thirdUpline->live_balance / 100) + $commission) * 100;

    $thirdUpline->update(['live_balance' => $newThirdUplineBalance]);

    Referral::create([
      'user_id' => $thirdUpline->id,
      'referral_code' => $referralCode,
      'amount' => $commission * 100,
      'level' => '1'
    ]);

    $thirdUpline->notify(new CommissionEarned($thirdUpline->name, $depositOwnerName, strval($commission)));
  }

  public function approveDeposit(int $depositId, int $userId, int $amount)
  {
    try {
      DB::transaction(function () use ($depositId, $userId, $amount) {
        // Lock the user and deposit records for update
        $user = User::where('id', $userId)->lockForUpdate()->first();
        $deposit = Deposit::where('id', $depositId)->lockForUpdate()->first();

        // Check if deposit is already processed
        if ($deposit->status !== 'pending') {
          throw new \Exception('Deposit has already been processed');
        }

        $userLiveBalance = $user->live_balance;
        $newBalance = $userLiveBalance + $amount;

        $user->update(['live_balance' => $newBalance]);
        $deposit->update(['status' => 'approved']);

        $user->notify(new DepositApproved($user->name, strval($amount / 100)));

        if ($user->referred_by !== null) {
          $this->computeUpline($user->referred_by);
          $this->processReferralPayouts($amount / 100, $user->referral_code, $user->name);
        }
      });

      session()->flash('success-message', 'Deposit approved successfully');
    } catch (\Exception $e) {
      Log::error('Deposit approval failed: ' . $e->getMessage());
      session()->flash('error-message', 'Failed to approve deposit: ' . $e->getMessage());
    }
  }

  public function declineDeposit(int $depositId, int $userId, int $amount)
  {
    try {
      DB::transaction(function () use ($depositId, $userId, $amount) {
        // Lock the deposit record for update
        $deposit = Deposit::where('id', $depositId)->lockForUpdate()->first();
        $user = User::where('id', $userId)->first();

        // Check if deposit is already processed
        if ($deposit->status !== 'pending') {
          throw new \Exception('Deposit has already been processed');
        }

        $deposit->update(['status' => 'declined']);

        $user->notify(new DepositDeclined($user->name, strval($amount / 100)));
      });

      session()->flash('success-message', 'Deposit declined successfully');
    } catch (\Exception $e) {
      Log::error('Deposit decline failed: ' . $e->getMessage());
      session()->flash('error-message', 'Failed to decline deposit: ' . $e->getMessage());
    }
  }

  public function render()
  {
    $deposits = Deposit::with('user')->whereHas('user', function ($query) {
      $query->where('is_admin', 0);
    })->latest()->paginate(10);
    return view('livewire.admin.admin-deposit', [
      'deposits' => $deposits
    ]);
  }
}
