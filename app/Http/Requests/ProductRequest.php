<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
                    'name' => 'required|string|max:100|unique:products',
                    'category_id' => 'bail|required|numeric|exists:categories,id',
                    'rate' => 'required|numeric',
                    'quantity' => 'required|numeric',

                    'vendor_id' => 'bail|required|numeric|exists:vendors,id',
                ];
                break;
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => ['required', 'string', 'max:100', Rule::unique('products')->ignore($this->product)],
                    'category_id' => 'bail|required|numeric|exists:categories,id',
                    'rate' => 'required|numeric',
                    'quantity' => 'required|numeric',

                    'vendor_id' => 'bail|required|numeric|exists:vendors,id',
                ];
                break;
        }

    }
}
