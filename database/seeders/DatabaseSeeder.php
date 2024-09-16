<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'username' => 'muca',
            'email' => 'muca@admin.com',
            'is_admin'=> true,
            'password' => bcrypt('1234')
        ]);
    }
}
