<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Transaction::class);

        return ['transactions' => Transaction::with(['product', 'user'])->orderBy('created_at', 'DESC')->get()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $this->authorize('create', Transaction::class);

        $transaction = new Transaction;
        $transaction->fill($request->validated());
        $transaction->user_id = Auth::id();
        $transaction->save();

        $transaction->load(['product', 'user']);
        return ['transaction' => $transaction];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction);

        $transaction->load(['product', 'user']);
        return ['transaction' => $transaction];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        abort(403);
        $this->authorize('update', $transaction);

        $transaction->fill($request->validated());
        $transaction->save();

        return ['transaction' => $transaction];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete', $transaction);

        return ['success' => $transaction->delete()];
    }
}
