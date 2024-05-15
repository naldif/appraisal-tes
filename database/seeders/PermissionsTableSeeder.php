<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['name' => 'user-index'], 
            ['name' => 'user-create'], 
            ['name' => 'user-delete'], 
            ['name' => 'user-update'],
            ['name' => 'role-index'], 
            ['name' => 'role-create'], 
            ['name' => 'role-delete'], 
            ['name' => 'role-update'],
            ['name' => 'permission-index'], 
            ['name' => 'permission-create'], 
            ['name' => 'permission-delete'], 
            ['name' => 'permission-update'],
        ])->each(fn ($data) => Permission::create($data));
    }
}
