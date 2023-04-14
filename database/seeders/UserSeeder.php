<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $userOne = User::create([
            'first_name' => 'Kalpesh',
            'last_name'  => 'Popat',
            'email'      => 'kalpesh.popat@gmail.com',
            'password'   => Hash::make('Kalpesh@Popat'),
        ]);

        $userThree = User::create([
            'first_name' => 'Second',
            'last_name'  => 'User',
            'email'      => 'second.user@gmail.com',
            'password'   => Hash::make('Second@User'),
        ]);

        $userFour = User::create([
            'first_name' => 'Third',
            'last_name'  => 'User',
            'email'      => 'third.user@gmail.com',
            'password'   => Hash::make('Third@User'),
        ]);
    }
}
