<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        //
        $data = [
            [
                'email'          => 'admin@gmail.com',
                'password'          => Hash::make('admintiara77'),
                'level'             => 1,
                'status_user'       => 1
            ], [
                'email'          => 'dekapramesta77@gmail.com',
                'password'          => Hash::make('admindeka'),
                'level'             => 1,
                'status_user'       => 1
            ],
            [
                'email'          => 'tarin@gmail.com',
                'password'          => Hash::make('admintarin'),
                'level'             => 1,
                'status_user'       => 1
            ],

        ];
        foreach ($data as $dt) {
            $user = User::create($dt);
            $user->save();
        }
    }
}
