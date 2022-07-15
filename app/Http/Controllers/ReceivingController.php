<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceivingRequest;
use App\Models\Receiving;

class ReceivingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Receiving::class);
        
        return ['receivings' => Receiving::all()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReceivingRequest $request)
    {
        $this->authorize('create', Receiving::class);

        $receiving = new Receiving;
        $receiving->fill($request->validated());
        $receiving->save();

        return ['receiving' => $receiving];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receiving  $receiving
     * @return \Illuminate\Http\Response
     */
    public function show(Receiving $receiving)
    {
        $this->authorize('view', $receiving);

        return ['receiving' => $receiving];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receiving  $receiving
     * @return \Illuminate\Http\Response
     */
    public function update(ReceivingRequest $request, Receiving $receiving)
    {
        $this->authorize('update', $receiving);

        $receiving->fill($request->validated());
        $receiving->save();

        return ['receiving' => $receiving];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receiving  $receiving
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receiving $receiving)
    {
        $this->authorize('delete', $receiving);

        return ['success' => $receiving->delete()];
    }
}
