<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
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
        return [
            'transaction_date' => 'required|date',
            'product_id' => 'bail|required|numeric|exists:products,id',
            'quantity' => 'required|numeric',
            'transaction_type' => ['required', 'string', Rule::in([Transaction::TRANSACTION_TYPE_IN, Transaction::TRANSACTION_TYPE_OUT])],
        ];
    }
}
