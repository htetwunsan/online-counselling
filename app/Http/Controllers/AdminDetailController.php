<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminDetailRequest;
use App\Http\Requests\UpdateAdminDetailRequest;
use App\Models\AdminDetail;

class AdminDetailController extends Controller
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
     * @param  \App\Http\Requests\StoreAdminDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminDetail  $adminDetail
     * @return \Illuminate\Http\Response
     */
    public function show(AdminDetail $adminDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminDetail  $adminDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminDetail $adminDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminDetailRequest  $request
     * @param  \App\Models\AdminDetail  $adminDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminDetailRequest $request, AdminDetail $adminDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminDetail  $adminDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminDetail $adminDetail)
    {
        //
    }
}
