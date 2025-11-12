<?php

namespace App\Livewire\Dashboard;

use App\Models\Deposit;
use App\Models\User;
use App\Notifications\DepositInitiated;
use App\Notifications\TransactionOccured;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.app')]

class ConfirmDeposit extends Component
{
  #[Url]
  public $amount;

  #[Url]
  public $method;

  #[Url]
  public $address;

  public function createDeposit()
  {
    try {
      // Wrap all operations in a database transaction for ACID compliance
      DB::transaction(function () {
        $userId = auth()->user()->id;

        // Create deposit record within transaction
        $deposit = Deposit::create([
          'user_id' => $userId,
          'payment_method' => $this->method,
          'amount' => $this->amount,
          'status' => 'pending'
        ]);

        // Fetch user with lock for consistency and isolation
        $user = User::lockForUpdate()->find($userId);
        if (!$user) {
          throw new \Exception('User not found');
        }

        // Fetch admin with lock for consistency
        $admin = User::lockForUpdate()
          ->where('is_admin', 1)
          ->first();

        if (!$admin) {
          throw new \Exception('Admin user not found');
        }

        // Send notifications (queued notifications will be part of transaction)
        $user->notify(new DepositInitiated($user->name, strval($this->amount / 100)));
        $admin->notify(new TransactionOccured('deposit', $user->name, strval($this->amount / 100)));
      }, attempts: 3);

      // Only flash and redirect after successful transaction commit
      session()->flash('message', 'Deposit successful. You will receive an email when deposit has been confirmed.');
      $this->redirectRoute('dashboard.deposithistory');
    } catch (\Exception $e) {
      // Transaction will be automatically rolled back on exception
      $this->dispatch('deposit-error', message: $e->getMessage())->self();
    }
  }

  public function render()
  {
    return view('livewire.dashboard.confirm-deposit');
  }
}
