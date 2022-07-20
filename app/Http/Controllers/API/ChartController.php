<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
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

    public function topProducts(Request $request)
    {
        return [
            'top_products' => Product::orderBy('quantity', 'DESC')
                ->limit(50)
                ->get(['name', 'quantity']),
        ];
    }

    public function hotProducts(Request $request)
    {
        return [
            'hot_products' => Transaction::selectRaw('products.id, products.name, COUNT(transactions.id) as c_all')
                ->join('products', 'products.id', 'transactions.product_id')
                ->groupBy('products.id')
                ->orderByRaw('COUNT(transactions.id) DESC')
                ->limit(50)
                ->get(),
        ];
    }
}
