<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'riisheee001@gmail.com'],
            [
                'name' => 'riishee',
                'password' => Hash::make('Vijay@12345'),
            ]
        );
    }
}
