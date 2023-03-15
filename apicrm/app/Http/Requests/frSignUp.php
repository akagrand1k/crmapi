<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class frSignUp extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'firstname' => ['required', 'string'],
            'middlename' => ['string'],
            'lastname' => ['required', 'string'],
            'birthday' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'phone' => ['required', 'min:4'],
            'email' => ['required', 'email'], // 'unique:users,email',
            'password' => ['required', 'min:6'],
            'roles' => ['sometimes', 'array'],
            //'roles.*' => ['sometimes', Rule::notIn(['owner', 'superadmin'])]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([

        ]);
    }
}
