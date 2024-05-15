<?php

namespace Database\Seeders;

use App\Models\DetailUser;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DetailUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailUser::create([
            'users_id' => 1,
            'role' => 'superadmin',
            'contact_number' => '911234567891',
            'photo' => null
        ]);
    }
}
