<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Super Admin']);

        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleUser = Role::create(['name' => 'User']);

        // viewAny, view, create, update, delete
        foreach (['Product', 'Vendor', 'Category', 'Receiving', 'Dispatch'] as $m) {
            foreach (['viewAny', 'view', 'create', 'update', 'delete'] as $p) {
                $permission = Permission::create(['name' => $p . ' ' . strtolower($m)]);
                $roleAdmin->givePermissionTo($permission);
                $roleUser->givePermissionTo($permission);
            }
        }

        foreach (['Role'] as $m) {
            foreach (['viewAny', 'view', 'create', 'update'] as $p) {
                $permission = Permission::create(['name' => $p . ' ' . strtolower($m)]);
                $roleAdmin->givePermissionTo($permission);
                $roleUser->givePermissionTo($permission);
            }
        }

        foreach (['Permission'] as $m) {
            foreach (['create', 'delete'] as $p) {
                $permission = Permission::create(['name' => $p . ' ' . strtolower($m)]);
                $roleAdmin->givePermissionTo($permission);
                $roleUser->givePermissionTo($permission);
            }
        }

    }
}
