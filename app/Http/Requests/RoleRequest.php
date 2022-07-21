<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
                    'name' => 'required|string|max:100|unique:roles',
                ];
                break;
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => ['required', 'string', 'max:100', Rule::unique('roles')->ignore($this->role)],
                ];
                break;
        }
    }
}
