<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        $product = $transaction->product;
        switch ($transaction->transaction_type) {
            case Transaction::TRANSACTION_TYPE_IN:
                $product->quantity += $transaction->quantity;
                break;
            case Transaction::TRANSACTION_TYPE_OUT:
                $product->quantity -= $transaction->quantity;
                break;
        }
        $product->save();
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        $product = $transaction->product;
        switch ($transaction->transaction_type) {
            case Transaction::TRANSACTION_TYPE_IN:
                $product->quantity -= $transaction->quantity;
                break;
            case Transaction::TRANSACTION_TYPE_OUT:
                $product->quantity += $transaction->quantity;
                break;
        }
        $product->save();
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
