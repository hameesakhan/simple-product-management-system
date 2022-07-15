<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRequest;
use App\Models\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Vendor::class);
        
        return ['vendors' => Vendor::all()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request)
    {
        $this->authorize('create', Vendor::class);

        $vendor = new Vendor;
        $vendor->fill($request->validated());
        $vendor->save();

        return ['vendor' => $vendor];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        $this->authorize('view', $vendor);

        return ['vendor' => $vendor];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, Vendor $vendor)
    {
        $this->authorize('update', $vendor);

        $vendor->fill($request->validated());
        $vendor->save();

        return ['vendor' => $vendor];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $this->authorize('delete', $vendor);

        return ['success' => $vendor->delete()];
    }
}
