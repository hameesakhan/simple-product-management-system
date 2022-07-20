<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Product::class);

        if ($request->has('barcode_identifier')) {
            $this->validate($request, [
                'barcode_identifier' => 'required|numeric',
            ]);
            $barcodeIdentifier = $request->query('barcode_identifier');

            $product = Product::where('barcode_identifier', $barcodeIdentifier)->firstOrFail();
            return ['product' => $product];
        }

        return [
            'products' => Product::with(['user', 'vendor', 'category'])->simplePaginate(50),
            'total' => Product::count(),
            'per_page' => 50,
        ];
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
            $barcodeIdentifier = random_int(1000000000000, 9999999999999);
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
