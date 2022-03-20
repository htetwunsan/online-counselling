<?php

namespace App\Http\Requests;

use App\Models\PreferLanguage;
use App\Models\Service;
use App\Models\Speciality;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class CounsellorRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $specialities = Speciality::pluck('id');
        $services = Service::pluck('id');
        $preferLanguages = PreferLanguage::pluck('id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'description' => ['string'],
            'image' => ['required', 'image'],
            'specialities.*' => [Rule::in($specialities)],
            'services.*' => [Rule::in($services)],
            'languages.*' => [Rule::in($preferLanguages)]
        ];
    }
}
