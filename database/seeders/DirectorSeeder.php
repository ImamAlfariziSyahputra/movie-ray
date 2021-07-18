<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('directors')->insert([
            [
                'name' => "Russo Brothers",
                'image' => 'https://www.indiewire.com/wp-content/uploads/2021/03/RUSSO-HEADSHOT-APPROVED-2021.jpg?w=780',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => "Zack Snyder",
                'image' => 'https://non-indonesia-distribution.brta.in/2017-05/466050d9f88f76ac3b0708231c3ae379.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
