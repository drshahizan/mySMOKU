<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $demoUser = User::create([
            'nokp'              => '111111111111',
            'email'             => 'pelajar@demo.com',
            'password'          => Hash::make('demo'),
            'tahap'             => '1',
            'email_verified_at' => now(),
        ]);

        $demoUser2 = User::create([
            'nokp'              => '222222222222',
            'email'             => 'penyelaras@demo.com',
            'password'          => Hash::make('demo'),
            'tahap'             => '2',
            'email_verified_at' => now(),
        ]);

        $demoUser3 = User::create([
            'nokp'              => '333333333333',
            'email'             => 'sektretariat@demo.com',
            'password'          => Hash::make('demo'),
            'tahap'             => '3',
            'email_verified_at' => now(),
        ]);

        $demoUser4 = User::create([
            'nokp'              => '444444444444',
            'email'             => 'pegawai@demo.com',
            'password'          => Hash::make('demo'),
            'tahap'             => '4',
            'email_verified_at' => now(),
        ]);
    }
}
