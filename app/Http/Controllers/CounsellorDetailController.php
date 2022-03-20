<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCounsellorDetailRequest;
use App\Http\Requests\UpdateCounsellorDetailRequest;
use App\Models\Booking;
use App\Models\CounsellorDetail;
use Illuminate\Support\Facades\Auth;

class CounsellorDetailController extends Controller
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
     * @param  \App\Http\Requests\StoreCounsellorDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCounsellorDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CounsellorDetail  $counsellorDetail
     * @return \Illuminate\Http\Response
     */
    public function show(CounsellorDetail $counsellorDetail)
    {
        $counsellorDetail->load(['user', 'latestImage', 'specialities', 'services', 'preferLanguages']);
        $hasBooked = Auth::user()->clientDetail->hasBooked($counsellorDetail);
        return view('counsellors.show', ['counsellor' => $counsellorDetail, 'hasBooked' => $hasBooked]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CounsellorDetail  $counsellorDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(CounsellorDetail $counsellorDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCounsellorDetailRequest  $request
     * @param  \App\Models\CounsellorDetail  $counsellorDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCounsellorDetailRequest $request, CounsellorDetail $counsellorDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CounsellorDetail  $counsellorDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(CounsellorDetail $counsellorDetail)
    {
        //
    }
}
