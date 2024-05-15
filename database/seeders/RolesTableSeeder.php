<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['name' => 'superadmin'],
            ['name' => 'admin'],
            ['name' => 'petugas'],
            ['name' => 'leader'],
            ['name' => 'supervisor'],
            ['name' => 'manager'],
        ])->each(fn ($data) => Role::create($data));
    }
}
