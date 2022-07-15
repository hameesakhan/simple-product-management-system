<?php

namespace App\Http\Controllers;

use App\Http\Requests\DispatchRequest;
use App\Models\Dispatch;

class DispatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Dispatch::class);
        
        return ['dispatches' => Dispatch::all()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DispatchRequest $request)
    {
        $this->authorize('create', Dispatch::class);

        $dispatch = new Dispatch;
        $dispatch->fill($request->validated());
        $dispatch->save();

        return ['dispatch' => $dispatch];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function show(Dispatch $dispatch)
    {
        $this->authorize('view', $dispatch);

        return ['dispatch' => $dispatch];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function update(DispatchRequest $request, Dispatch $dispatch)
    {
        $this->authorize('update', $dispatch);

        $dispatch->fill($request->validated());
        $dispatch->save();

        return ['dispatch' => $dispatch];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dispatch $dispatch)
    {
        $this->authorize('delete', $dispatch);

        return ['success' => $dispatch->delete()];
    }
}
