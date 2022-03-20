<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CounsellorRegistrationRequest;
use App\Models\CounsellorDetail;
use App\Models\Image;
use App\Models\PreferLanguage;
use App\Models\Service;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

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
        $specialities = Speciality::all();
        $services = Service::all();
        $preferLanguages = PreferLanguage::all();

        return view('admin.counsellors.create', compact('specialities', 'services', 'preferLanguages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CounsellorRegistrationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CounsellorRegistrationRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'counsellor'
        ]);

        $src = $request->file('image')->storePublicly('images', 'images');

        Image::create([
            'src' => '/' . $src,
            'alt' => '',
            'imageable_id' => $user->detail->id,
            'imageable_type' => CounsellorDetail::class
        ]);

        $user->detail->update(['description' => $request->description]);
        $user->detail->specialities()->withTimestamps()->syncWithoutDetaching($request->specialities);
        $user->detail->services()->withTimestamps()->syncWithoutDetaching($request->services);
        $user->detail->preferLanguages()->withTimestamps()->syncWithoutDetaching($request->languages);

        event(new Registered($user));

        return back()->with('success', 'Successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CounsellorDetail  $counsellorDetail
     * @return \Illuminate\Http\Response
     */
    public function show(CounsellorDetail $counsellorDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CounsellorDetail  $counsellorDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(CounsellorDetail $counsellorDetail)
    {
        $specialities = Speciality::all();
        $services = Service::all();
        $preferLanguages = PreferLanguage::all();

        $specialities->each(fn ($s) => $s->checked = $counsellorDetail->specialities->contains($s));
        $services->each(fn ($s) => $s->checked = $counsellorDetail->services->contains($s));
        $preferLanguages->each(fn ($pl) => $pl->checked = $counsellorDetail->preferLanguages->contains($pl));

        return view('admin.counsellors.edit', compact('specialities', 'services', 'preferLanguages', 'counsellorDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CounsellorDetail  $counsellorDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CounsellorDetail $counsellorDetail)
    {
        $specialities = Speciality::pluck('id');
        $services = Service::pluck('id');
        $preferLanguages = PreferLanguage::pluck('id');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($counsellorDetail->user_id)],
            'description' => ['string'],
            'image' => ['image'],
            'specialities.*' => [Rule::in($specialities)],
            'services.*' => [Rule::in($services)],
            'languages.*' => [Rule::in($preferLanguages)]
        ]);

        $counsellorDetail->user->update(['name' => $request->name, 'email' => $request->email]);

        if ($request->hasFile('image')) {
            $src = $request->file('image')->storePublicly('images');

            Image::create([
                'src' => '/' . $src,
                'alt' => '',
                'imageable_id' => $counsellorDetail->id,
                'imageable_type' => CounsellorDetail::class
            ]);
        }

        $counsellorDetail->update(['description' => $request->description]);
        $counsellorDetail->specialities()->withTimestamps()->sync($request->specialities);
        $counsellorDetail->services()->withTimestamps()->sync($request->services);
        $counsellorDetail->preferLanguages()->withTimestamps()->sync($request->languages);

        return back()->with('success', 'Successfully updated.');
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
