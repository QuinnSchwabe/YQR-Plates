<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TempDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Somto Igbokwe',
            'email' => 'somto@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('pass1'),//always hash passwords to proteect usr data and it uses laravel built in bcrypt
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Brett Harley',
            'email' => 'brett@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('pass2'),//always hash passwords to proteect usr data and it uses laravel built in bcrypt
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Patrick Fidek',
            'email' => 'patrick@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('pass3'),//always hash passwords to proteect usr data and it uses laravel built in bcrypt
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Quinn Schwabe',
            'email' => 'quinn@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('pass4'),//always hash passwords to proteect usr data and it uses laravel built in bcrypt
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Dharma Tejash',
            'email' => 'dharma@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('pass5'),//always hash passwords to proteect usr data and it uses laravel built in bcrypt
            'remember_token' => Str::random(10),
        ]);
    }
}
