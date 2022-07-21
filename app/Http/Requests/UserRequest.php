<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|string',
                    'role' => 'required|string|exists:roles,name',
                ];
                break;
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|string',
                    'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
                    'password' => 'nullable|string',
                    'role' => 'required|string|exists:roles,name',
                ];
                break;
        }

    }
}
