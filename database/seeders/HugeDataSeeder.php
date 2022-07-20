<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class HugeDataSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'abc@def.gh',
        ]);
        $user->syncRoles(['Super Admin']);

        $category = \App\Models\Category::factory()->create([
            'name' => 'Test Category',
            'user_id' => $user->id,
        ]);

        $vendor = \App\Models\Vendor::factory()->create([
            'name' => 'Test Vendor',
            'user_id' => $user->id,
        ]);

        // \App\Models\Product::factory(5000)->create([
        //     'category_id' => $category->id,
        //     'vendor_id' => $vendor->id,
        //     'user_id' => $user->id,
        // ]);

        $totalRowstoInsert = 5000;
        $rowsInSingleTransaction = 5000;
        for ($i = 0; $i < ($totalRowstoInsert / $rowsInSingleTransaction); $i++) {
            $rows = [];
            for ($j = 0; $j < $rowsInSingleTransaction; $j++) {
                array_push($rows, [
                    'barcode_identifier' => fake()->ean13(),
                    'name' => fake()->unique()->sentence(3),
                    'quantity' => fake()->randomNumber(3, false),
                    'category_id' => $category->id,
                    'vendor_id' => $vendor->id,
                    'user_id' => $user->id,
                ]);
            }
            \App\Models\Product::insert($rows);
            $rows = [];
        }

        // $product = \App\Models\Product::inRandomOrder()->first();

        // \App\Models\Dispatch::factory(1000000)->create([
        //     'product_id' => $product->id,
        //     'user_id' => $user->id,
        // ]);
        // $totalRowstoInsert = 1000000;
        // $rowsInSingleTransaction = 10000;
        // for ($i = 0; $i < ($totalRowstoInsert / $rowsInSingleTransaction); $i++) {
        //     $rows = [];
        //     for ($j = 0; $j < $rowsInSingleTransaction; $j++) {
        //         array_push($rows, [
        //             'quantity' => fake()->randomNumber(2, false),
        //             'dispatch_date' => fake()->date(),
        //             'product_id' => $product->id,
        //             'user_id' => $user->id,
        //         ]);
        //     }
        //     \App\Models\Dispatch::insert($rows);
        //     $rows = [];
        // }

        // \App\Models\Receiving::factory(1000000)->create([
        //     'product_id' => $product->id,
        //     'user_id' => $user->id,
        // ]);
        // $totalRowstoInsert = 1000000;
        // $rowsInSingleTransaction = 10000;
        // for ($i = 0; $i < ($totalRowstoInsert / $rowsInSingleTransaction); $i++) {
        //     $rows = [];
        //     for ($j = 0; $j < $rowsInSingleTransaction; $j++) {
        //         array_push($rows, [
        //             'quantity' => fake()->randomNumber(2, false),
        //             'receiving_date' => fake()->date(),
        //             'product_id' => $product->id,
        //             'user_id' => $user->id,
        //         ]);
        //     }
        //     \App\Models\Receiving::insert($rows);
        //     $rows = [];
        // }

        // \App\Models\Transaction::factory(2000000)->create([
        //     'product_id' => $product->id,
        //     'user_id' => $user->id,
        // ]);
        $totalRowstoInsert = 2000000;
        $rowsInSingleTransaction = 10000;
        for ($i = 0; $i < ($totalRowstoInsert / $rowsInSingleTransaction); $i++) {
            $rows = [];
            for ($j = 0; $j < $rowsInSingleTransaction; $j++) {
                array_push($rows, [
                    'quantity' => fake()->randomNumber(2, false),
                    'transaction_date' => fake()->date(),
                    'transaction_type' => fake()->randomElement([Transaction::TRANSACTION_TYPE_IN, Transaction::TRANSACTION_TYPE_OUT]),
                    'product_id' => fake()->randomNumber(4, false),
                    'user_id' => $user->id,
                ]);
            }
            \App\Models\Transaction::insert($rows);
            $rows = [];
        }
    }
}
