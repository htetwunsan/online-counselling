<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRegistrationRequest;
use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class RegisteredClientController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @param  \App\Http\Requests\ClientRegistrationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(ClientRegistrationRequest $request)
    {
        $specialities = Question::with('specialities')->find($request->questions)
            ->pluck('specialities')->flatten()->pluck('id');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client'
        ]);

        $user->detail->questions()->withTimestamps()->syncWithoutDetaching($request->questions);
        $user->detail->specialities()->withTimestamps()->syncWithoutDetaching($specialities);
        $user->detail->services()->withTimestamps()->syncWithoutDetaching($request->services);
        $user->detail->preferLanguages()->withTimestamps()->syncWithoutDetaching($request->languages);

        event(new Registered($user));

        return response('', 201);
    }
}
