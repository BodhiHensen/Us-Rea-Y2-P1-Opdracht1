<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'rolename' => 'admin',
                'password' => 'wachtwoord',
            ],
            [
                'name' => 'klant',
                'email' => 'klant@example.com',
                'rolename' => 'klant',
                'password' => 'wachtwoord',
            ],
            [
                'name' => 'magazijnmedewerker',
                'email' => 'magazijnmedewerker@example.com',
                'rolename' => 'magazijnmedewerker',
                'password' => 'wachtwoord',
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'rolename' => $user['rolename'],
                    'password' => $user['password'],
                ]
            );
        }
    }
}
