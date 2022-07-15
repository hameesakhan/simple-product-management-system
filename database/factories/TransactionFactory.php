<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Transaction;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'quantity' => fake()->randomNumber(2, false),
            'receiving_date' => fake()->date(),
            'transaction_type' => fake()->randomElement([[Transaction::TRANSACTION_TYPE_IN, Transaction::TRANSACTION_TYPE_OUT]])
        ];
    }

}
