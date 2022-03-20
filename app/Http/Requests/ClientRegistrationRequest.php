<?php

namespace App\Http\Requests;

use App\Models\PreferLanguage;
use App\Models\Question;
use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class ClientRegistrationRequest extends FormRequest
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
        $questions = Question::pluck('id');
        $services = Service::pluck('id');
        $preferLanguages = PreferLanguage::pluck('id');
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'questions.*' => [Rule::in($questions)],
            'services.*' => [Rule::in($services)],
            'languages.*' => [Rule::in($preferLanguages)]
        ];
    }
}
