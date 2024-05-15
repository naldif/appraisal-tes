<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create(
            [
                'name'      => 'SuperAdmin',
                'email'     => 'superadmin@gmail.com',
                'password'  => bcrypt('password'),
            ],
        );

        $permissions = Permission::all();

        $role = Role::find(1);

        $role->syncPermissions($permissions);

        $user->assignRole($role);
    }
}
