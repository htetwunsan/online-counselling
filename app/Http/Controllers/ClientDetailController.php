<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientDetailRequest;
use App\Http\Requests\UpdateClientDetailRequest;
use App\Models\ClientDetail;

class ClientDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientDetail  $clientDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ClientDetail $clientDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientDetail  $clientDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientDetail $clientDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientDetailRequest  $request
     * @param  \App\Models\ClientDetail  $clientDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientDetailRequest $request, ClientDetail $clientDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientDetail  $clientDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientDetail $clientDetail)
    {
        //
    }
}
