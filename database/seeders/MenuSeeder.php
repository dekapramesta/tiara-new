<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama' => 'pastel',
                'gambar' => 'pastel.jpg',
                'harga' => 1500,
                'id_jenis'    => 2,
                'deskripsi'       => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque ipsam minus aliquid unde ut. Quidem, in magnam omnis exercitationem soluta aut maiores nihil suscipit quo iusto minus modi iste? Enim!
',

            ], [
                'nama' => 'brownies',
                'gambar' => 'brownies.jpg',
                'harga' => 1500,
                'id_jenis'    => 1,
                'deskripsi'       => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque ipsam minus aliquid unde ut. Quidem, in magnam omnis exercitationem soluta aut maiores nihil suscipit quo iusto minus modi iste? Enim!
',

            ]
        ];
        foreach ($data as $dt) {
            $menu = Menu::create($dt);
            $menu->save();
        }

        //
    }
}
