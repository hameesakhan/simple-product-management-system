<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            // HugeDataSeeder::class,
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'abc@def.gh',
        ]);
        $user->syncRoles(['Super Admin']);

        \App\Models\Category::factory(1000)->create([
            'user_id' => $user->id,
        ]);

        \App\Models\Vendor::factory(1000)->create([
            'user_id' => $user->id,
        ]);

        $totalRowstoInsert = 5000;
        $rowsInSingleTransaction = 5000;
        for ($i = 0; $i < ($totalRowstoInsert / $rowsInSingleTransaction); $i++) {
            $rows = [];
            for ($j = 0; $j < $rowsInSingleTransaction; $j++) {
                array_push($rows, [
                    'barcode_identifier' => fake()->ean13(),
                    'name' => fake()->unique()->sentence(3),
                    'quantity' => fake()->randomNumber(3, false),
                    'category_id' => fake()->randomNumber(3, false),
                    'vendor_id' => fake()->randomNumber(3, false),
                    'user_id' => $user->id,
                ]);
            }
            \App\Models\Product::insert($rows);
            $rows = [];
        }

    }
}
