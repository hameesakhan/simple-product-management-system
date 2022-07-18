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
        ]);

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

    }
}
