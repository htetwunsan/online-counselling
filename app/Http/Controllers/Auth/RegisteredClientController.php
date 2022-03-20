<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRegistrationRequest;
use App\Models\PreferLanguage;
use App\Models\Question;
use App\Models\Service;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class RegisteredClientController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $questions = Question::all();
        $services = Service::all();
        $preferLanguages = PreferLanguage::all();
        return view('auth.register', compact('questions', 'services', 'preferLanguages'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \App\Http\Requests\ClientRegistrationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(ClientRegistrationRequest $request)
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

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
