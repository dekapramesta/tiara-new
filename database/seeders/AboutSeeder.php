<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
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
                'title_kelebihan'          => 'Harga Terjangkau',

                'desk_kelebihan'       => 'sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.'
            ], [
                'title_kelebihan'          => 'Homemade Product',

                'desk_kelebihan'       => 'sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.'
            ],


        ];
        foreach ($data as $dt) {
            $user = About::create($dt);
            $user->save();
        }
    }
}
