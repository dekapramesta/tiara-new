<?php

namespace Database\Seeders;

use App\Models\JenisMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisMenuSeeder extends Seeder
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
                'jenis'          => 'Kue',

            ], [
                'jenis'          => 'Roti',

            ],
            [
                'jenis'          => 'Kue Kering',

            ],
            [
                'jenis'          => 'Kue Basah',

            ],

        ];
        foreach ($data as $dt) {
            $user = JenisMenu::create($dt);
            $user->save();
        }
    }
}
