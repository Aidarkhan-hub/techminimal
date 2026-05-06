<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'edit own products']);
        Permission::create(['name' => 'delete own products']);
        Permission::create(['name' => 'delete any product']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'view analytics']);

        // Roles
        $customer = Role::create(['name' => 'customer']);
        $customer->givePermissionTo(['view products']);

        $seller = Role::create(['name' => 'seller']);
        $seller->givePermissionTo(['view products', 'create products', 'edit own products', 'delete own products']);

        $manager = Role::create(['name' => 'manager']);
        $manager->givePermissionTo(['view products', 'view users', 'view analytics', 'delete any product']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        // Users
        $customer1 = User::create([
            'name' => 'Customer User',
            'email' => 'customer@test.com',
            'password' => Hash::make('password'),
        ]);
        $customer1->assignRole('customer');

        $seller1 = User::create([
            'name' => 'Seller User',
            'email' => 'seller@test.com',
            'password' => Hash::make('password'),
        ]);
        $seller1->assignRole('seller');

        $manager1 = User::create([
            'name' => 'Manager User',
            'email' => 'manager@test.com',
            'password' => Hash::make('password'),
        ]);
        $manager1->assignRole('manager');

        $admin1 = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
        ]);
        $admin1->assignRole('admin');
    }
}
