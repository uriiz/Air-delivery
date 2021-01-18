<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'name'=> 'ishay',
            'email'=> 'Ely@titan-soft.com',
            'logo'=> '/images/user_profile.jpg',
            'role'=> 3,
            'password'=> Hash::make('121234'),
        ]);
    }
}
