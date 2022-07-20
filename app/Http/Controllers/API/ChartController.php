<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ChartController extends Controller
{
    public function transactions(Request $request)
    {
        return [
            'transactions' => Transaction::groupBy('transaction_date')
                ->selectRaw('transaction_date, COUNT(*) as c_all')
                ->whereBetween('transaction_date', [Carbon::now()->subDays(30)->format('Y-m-d'), Carbon::now()->format('Y-m-d')])
                ->orderBy('transaction_date')
                ->get(),
        ];
    }

    public function ins(Request $request)
    {
        return [
            'ins' => Transaction::groupBy('transaction_date')
                ->selectRaw('transaction_date, SUM(quantity) as s_quantity')
                ->whereBetween('transaction_date', [Carbon::now()->subDays(30)->format('Y-m-d'), Carbon::now()->format('Y-m-d')])
                ->where('transaction_type', Transaction::TRANSACTION_TYPE_IN)
                ->orderBy('transaction_date')
                ->get(),
        ];
    }

    public function outs(Request $request)
    {
        return [
            'outs' => Transaction::groupBy('transaction_date')
                ->selectRaw('transaction_date, SUM(quantity) as s_quantity')
                ->whereBetween('transaction_date', [Carbon::now()->subDays(30)->format('Y-m-d'), Carbon::now()->format('Y-m-d')])
                ->where('transaction_type', Transaction::TRANSACTION_TYPE_OUT)
                ->orderBy('transaction_date')
                ->get(),
        ];
    }
}
