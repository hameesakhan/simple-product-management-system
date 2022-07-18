<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Product::class);

        return ['products' => Product::with(['user', 'vendor', 'category'])->get()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->authorize('create', Product::class);

        $product = new Product;
        $product->fill($request->validated());
        $product->user_id = Auth::id();

        do {
            // Using EAN-14 (13 digit code)
            $barcodeIdentifier = sprintf("%'.013d", rand(0, 999999999999));
        } while (
            Product::where('barcode_identifier', $barcodeIdentifier)->count()
        );
        $product->barcode_identifier = $barcodeIdentifier;
        $product->save();

        $product->load(['user', 'vendor', 'category']);
        return ['product' => $product];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $this->authorize('view', $product);
        $product->load(['user', 'vendor', 'category']);

        return ['product' => $product];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $product->fill($request->validated());
        $product->save();
        $product->load(['user', 'vendor', 'category']);

        return ['product' => $product];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        return ['success' => $product->delete()];
    }
}
