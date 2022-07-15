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

        $user = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $category = \App\Models\Category::factory()->create([
            'name' => 'Test Category',
            'user_id' => $user->id,
        ]);

        $vendor = \App\Models\Vendor::factory()->create([
            'name' => 'Test Vendor',
            'user_id' => $user->id,
        ]);

        \App\Models\Product::factory(5000)->create([
            'category_id' => $category->id,
            'vendor_id' => $vendor->id,
            'user_id' => $user->id,
        ]);

        $product = \App\Models\Product::inRandomOrder()->first();
        \App\Models\Dispatch::factory(1000000)->create([
            'product_id' => $product->id,
            'user_id' => $user->id,
        ]);
        \App\Models\Receiving::factory(1000000)->create();
        
        \App\Models\Transaction::factory(2000000)->create();

        $this->call([
            RoleSeeder::class,
        ]);
    }
}
