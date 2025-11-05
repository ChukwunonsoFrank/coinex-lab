<?php

namespace App\Livewire\Dashboard;

use App\Livewire\Dashboard\Partials\AssetIndicator;
use App\Models\Bot;
use App\Models\Strategy;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Traderoom extends Component
{
  public ?Bot $activeBot = null;

  public ?int $timerCheckpoint = null;

  public float $amount = 0;

  public string $accountType = '';

  public string $strategy = '';

  public string $profitLimit = '';

  public float $profit = 0;

  public string $asset = '';

  public string $assetIcon = '';

  public string $sentiment = '';

  private const AMOUNT_MULTIPLIER = 100;

  public function mount(): void
  {
    if (session()->has('message')) {
      $this->dispatch('robot-created', message: session()->get('message'))->self();
    }

    $this->activeBot = Bot::where([
      'user_id' => auth()->id(),
      'status' => 'active'
    ])->first();

    if (!$this->activeBot) {
      $this->redirectRoute('dashboard.robot');
      return;
    }

    $this->initializeBotData();
  }

  private function initializeBotData(): void
  {
    $strategy = Strategy::findOrFail($this->activeBot->strategy);

    $this->amount = $this->normalizeAmount($this->activeBot->amount);
    $this->accountType = $this->activeBot->account_type === 'demo' ? 'Demo account' : 'Live account';
    $this->strategy = $strategy->name;
    $this->profitLimit = $strategy->max_roi;
    $this->profit = $this->normalizeAmount($this->activeBot->profit);
    $this->asset = $this->activeBot->asset;
    $this->assetIcon = $this->activeBot->asset_image_url;
    $this->sentiment = $this->activeBot->sentiment;
    $this->timerCheckpoint = $this->activeBot->timer_checkpoint;
  }

  private function normalizeAmount(int $amount): float
  {
    return $amount / self::AMOUNT_MULTIPLIER;
  }

  private function serializeAmount(float $amount): int
  {
    return (int) ($amount * self::AMOUNT_MULTIPLIER);
  }

  public function refreshAssetData(): void
  {
    $this->activeBot = Bot::where([
      'user_id' => auth()->id(),
      'status' => 'active'
    ])->first();

    if (!$this->activeBot) {
      return;
    }

    $this->profit = $this->normalizeAmount($this->activeBot->profit);
    $this->asset = $this->activeBot->asset;
    $this->assetIcon = $this->activeBot->asset_image_url;
    $this->sentiment = $this->activeBot->sentiment;
    $this->timerCheckpoint = $this->activeBot->timer_checkpoint;

    $this->dispatch('asset-updated', data: [
      'asset' => $this->activeBot->asset,
      'assetImageUrl' => $this->activeBot->asset_image_url,
      'assetClass' => $this->activeBot->asset_class,
      'isBotActive' => true
    ])->to(AssetIndicator::class);
  }

  public function stopRobot(): void
  {
    try {
      DB::transaction(function () {
        // Lock the bot record for update to prevent race conditions
        $bot = Bot::where('id', $this->activeBot->id)
          ->where('status', 'active')
          ->lockForUpdate()
          ->first();

        if (!$bot) {
          throw new \RuntimeException('Bot is no longer active or does not exist');
        }

        // Lock the user record for update
        $user = User::where('id', auth()->id())
          ->lockForUpdate()
          ->first();

        if (!$user) {
          throw new \RuntimeException('User not found');
        }

        // Calculate new balance
        $balanceField = $bot->account_type === 'demo' ? 'demo_balance' : 'live_balance';
        $currentBalance = $this->normalizeAmount($user->$balanceField);
        $botAmount = $this->normalizeAmount($bot->amount);
        $botProfit = $this->normalizeAmount($bot->profit);
        $newBalance = $this->serializeAmount($currentBalance + $botAmount + $botProfit);

        // Validate new balance is non-negative
        if ($newBalance < 0) {
          throw new \RuntimeException('Calculated balance cannot be negative');
        }

        // Update bot status
        $bot->update(['status' => 'stopped']);

        // Update user balance
        $user->update([$balanceField => $newBalance]);
      });

      session()->flash('message', 'Robot has stopped trading');
      $this->redirectRoute('dashboard.robot');
    } catch (\Exception $e) {
      Log::error('Error stopping robot', [
        'user_id' => auth()->id(),
        'bot_id' => $this->activeBot->id ?? null,
        'error' => $e->getMessage()
      ]);

      $this->dispatch('stop-robot-error', message: 'Failed to stop robot. Please try again.')->self();
    }
  }

  public function render()
  {
    return view('livewire.dashboard.traderoom');
  }
}
