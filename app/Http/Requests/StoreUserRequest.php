<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'firstName' => 'required',
            'lastName' => 'required',
            'jobTitle' => 'required',
            'hourlyRate' => 'required|numeric',
            'currency' => 'required',
        ];
    }
}
