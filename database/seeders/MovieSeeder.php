<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->insert([
            [
                'director_id' => 1,
                'title' => 'Black Widow',
                'slug' => 'black-widow',
                'poster' => 'https://www.joblo.com/assets/images/joblo/posters/2021/05/black-widow-character-poster-2021-1_thumb.jpg',
                'banner' => 'https://travelmaker1.b-cdn.net/wp-content/uploads/2019/09/Black-Widow.jpg',
                'desc' => 'desc of black widow movie',
                'synopsis' => 'Natasha Romanoff, aka Black Widow, confronts the darker parts of her ledger when a dangerous conspiracy with ties to her past arises. Pursued by a force that will stop at nothing to bring her down, Natasha must deal with her history as a spy, and the broken relationships left in her wake long before she became an Avenger.',
                'trailer' => 'https://www.youtube.com/watch?v=ybji16u608U',
                'year' => '2021',
                'duration' => '134',
                'imdb_rating' => '6.9',
            ],
            [
                'director_id' => 2,
                'title' => 'Justice League',
                'slug' => 'justice-league',
                'poster' => 'https://wallpapercave.com/wp/wp7506885.jpg',
                'banner' => 'https://somethingcentral.com/wp-content/uploads/2021/04/AThumbnail3.jpeg',
                'desc' => 'desc of justice league movie',
                'synopsis' => "
                    Fueled by his restored faith in humanity and inspired by Superman's selfless act, Bruce Wayne enlists newfound ally Diana Prince to face an even greater threat. Together, Batman and Wonder Woman work quickly to recruit a team to stand against this newly awakened enemy. Despite the formation of an unprecedented league of heroes -- Batman, Wonder Woman, Aquaman, Cyborg and the Flash -- it may be too late to save the planet from an assault of catastrophic proportions.
                ",
                'trailer' => 'https://www.youtube.com/watch?v=vM-Bja2Gy04',
                'year' => '2021',
                'duration' => '242',
                'imdb_rating' => '8.1',
            ],
        ]);
    }
}
