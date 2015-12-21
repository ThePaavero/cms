<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user = new \App\User();
        $user->name = 'Example Admin';
        $user->email = 'admin@example.com';
        $user->password = \Illuminate\Support\Facades\Hash::make('admin');
        $user->save();
    }
}
