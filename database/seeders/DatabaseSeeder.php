<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        $users = [
            ['name' => 'Admin',    'email' => 'admin@test.com',    'role' => 'admin'],
            ['name' => 'Manager',  'email' => 'manager@test.com',  'role' => 'manager'],
            ['name' => 'Seller',   'email' => 'seller@test.com',   'role' => 'seller'],
            ['name' => 'Customer', 'email' => 'customer@test.com', 'role' => 'customer'],
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
