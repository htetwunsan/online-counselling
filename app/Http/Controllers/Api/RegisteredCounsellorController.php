<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CounsellorRegistrationRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class RegisteredCounsellorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\CounsellorRegistrationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CounsellorRegistrationRequest $request)
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

        return response('', 201);
    }
}
