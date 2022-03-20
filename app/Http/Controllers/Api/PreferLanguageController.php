<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StorePreferLanguageRequest;
use App\Http\Requests\UpdatePreferLanguageRequest;
use App\Models\PreferLanguage;

class PreferLanguageController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePreferLanguageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePreferLanguageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PreferLanguage  $preferLanguage
     * @return \Illuminate\Http\Response
     */
    public function show(PreferLanguage $preferLanguage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePreferLanguageRequest  $request
     * @param  \App\Models\PreferLanguage  $preferLanguage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePreferLanguageRequest $request, PreferLanguage $preferLanguage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreferLanguage  $preferLanguage
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreferLanguage $preferLanguage)
    {
        //
    }
}
