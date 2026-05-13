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

        $permissions = [
            'view products', 'create products', 'edit own products',
            'delete own products', 'delete any product',
            'view users', 'manage users', 'view analytics',
        ];
        foreach ($permissions as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        $customer = Role::firstOrCreate(['name' => 'customer']);
        $customer->givePermissionTo(['view products']);

        $seller = Role::firstOrCreate(['name' => 'seller']);
        $seller->givePermissionTo(['view products', 'create products', 'edit own products', 'delete own products']);

        $manager = Role::firstOrCreate(['name' => 'manager']);
        $manager->givePermissionTo(['view products', 'view users', 'view analytics', 'delete any product']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $users = [
            ['name' => 'Customer User', 'email' => 'customer@test.com', 'role' => 'customer'],
            ['name' => 'Seller User',   'email' => 'seller@test.com',   'role' => 'seller'],
            ['name' => 'Manager User',  'email' => 'manager@test.com',  'role' => 'manager'],
            ['name' => 'Admin User',    'email' => 'admin@test.com',    'role' => 'admin'],
        ];
        foreach ($users as $u) {
            $user = User::firstOrCreate(
                ['email' => $u['email']],
                ['name' => $u['name'], 'password' => Hash::make('password')]
            );
            $user->assignRole($u['role']);
        }
    }
}
