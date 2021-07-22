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
                'director_id' => 2,
                'title' => "Zack Snyder's Justice League",
                'slug' => 'zack-snyder-s-justice-league',
                'poster' => '/storage/photos/6/Poster/justice league poster.jpg',
                'banner' => '/storage/photos/6/Banner/justice league banner.jpg',
                'desc' => 'desc of justice league movie',
                'synopsis' => "Fueled by his restored faith in humanity and inspired by Superman's selfless act, Bruce Wayne enlists newfound ally Diana Prince to face an even greater threat. Together, Batman and Wonder Woman work quickly to recruit a team to stand against this newly awakened enemy. Despite the formation of an unprecedented league of heroes -- Batman, Wonder Woman, Aquaman, Cyborg and the Flash -- it may be too late to save the planet from an assault of catastrophic proportions.",
                'trailer' => 'https://www.youtube.com/watch?v=vM-Bja2Gy04',
                'year_id' => 1,
                'duration' => '242',
                'imdb_rating' => '8.1',
                'created_at' => date('Y:m:d H:i:s'),
                'updated_at' => date('Y:m:d H:i:s'),
            ],
            [
                'director_id' => 1,
                'title' => 'Black Widow',
                'slug' => 'black-widow',
                'poster' => 'https://www.joblo.com/assets/images/joblo/posters/2021/05/black-widow-character-poster-2021-1_thumb.jpg',
                'banner' => 'https://travelmaker1.b-cdn.net/wp-content/uploads/2019/09/Black-Widow.jpg',
                'desc' => "She's Done Running From Her Past.",
                'synopsis' => 'Natasha Romanoff, aka Black Widow, confronts the darker parts of her ledger when a dangerous conspiracy with ties to her past arises. Pursued by a force that will stop at nothing to bring her down, Natasha must deal with her history as a spy, and the broken relationships left in her wake long before she became an Avenger.',
                'trailer' => 'https://www.youtube.com/watch?v=ybji16u608U',
                'year' => 1,
                'duration' => '134',
                'imdb_rating' => '6.9',
                'created_at' => date('Y:m:d H:i:s'),
                'updated_at' => date('Y:m:d H:i:s'),
            ],
            [
                'director_id' => 1,
                'title' => "Avengers: Endgame",
                'slug' => 'avengers-endgame',
                'poster' => '/storage/photos/6/Poster/endgame poster.jpg',
                'banner' => '/storage/photos/6/Banner/endgame banner.jpg',
                'desc' => 'Part of the journey is the end.',
                'synopsis' => "After the devastating events of Avengers: Infinity War, the universe is in ruins due to the efforts of the Mad Titan, Thanos. With the help of remaining allies, the Avengers must assemble once more in order to undo Thanos’ actions and restore order to the universe once and for all, no matter what consequences may be in store.",
                'trailer' => 'https://www.youtube.com/watch?v=TcMBFSGVi1c',
                'year' => 3,
                'duration' => '182',
                'imdb_rating' => '8',
                'created_at' => date('Y:m:d H:i:s'),
                'updated_at' => date('Y:m:d H:i:s'),
            ],
            [
                'director_id' => 3,
                'title' => "Guardians of the Galaxy Vol. 2",
                'slug' => 'guardians-of-the-galaxy-vol-2',
                'poster' => '/storage/photos/6/Poster/gotg 2.jpg',
                'banner' => '/storage/photos/6/Banner/gotg 2.jpg',
                'desc' => 'Obviously.',
                'synopsis' => "The Guardians must fight to keep their newfound family together as they unravel the mysteries of Peter Quill’s true parentage.",
                'trailer' => 'https://www.youtube.com/watch?v=2cv2ueYnKjg',
                'year' => 5,
                'duration' => '138',
                'imdb_rating' => '7',
                'created_at' => date('Y:m:d H:i:s'),
                'updated_at' => date('Y:m:d H:i:s'),
            ],
            [
                'director_id' => 3,
                'title' => "Guardians of the Galaxy",
                'slug' => 'guardians-of-the-galaxy',
                'poster' => '/storage/photos/6/Poster/gotg 1.jpg',
                'banner' => '/storage/photos/6/Banner/gotg 1.png',
                'desc' => 'All heroes start somewhere.',
                'synopsis' => "Light years from Earth, 26 years after being abducted, Peter Quill finds himself the prime target of a manhunt after discovering an orb wanted by Ronan the Accuser.",
                'trailer' => 'https://www.youtube.com/watch?v=d96cjJhvlMA',
                'year' => 8,
                'duration' => '125',
                'imdb_rating' => '8',
                'created_at' => date('Y:m:d H:i:s'),
                'updated_at' => date('Y:m:d H:i:s'),
            ],
            [
                'director_id' => 1,
                'title' => "Ant Man",
                'slug' => 'ant-man',
                'poster' => '/storage/photos/6/Banner/ant man.jpg',
                'banner' => '/storage/photos/6/Poster/ant man.jpg',
                'desc' => "Heroes don't get any bigger.",
                'synopsis' => "Armed with the astonishing ability to shrink in scale but increase in strength, master thief Scott Lang must embrace his inner-hero and help his mentor, Doctor Hank Pym, protect the secret behind his spectacular Ant-Man suit from a new generation of towering threats. Against seemingly insurmountable obstacles, Pym and Lang must plan and pull off a heist that will save the world. ",
                'trailer' => 'https://youtu.be/79mfp1hY3Uw',
                'year' => 4,
                'duration' => '114',
                'imdb_rating' => '7',
                'created_at' => date('Y:m:d H:i:s'),
                'updated_at' => date('Y:m:d H:i:s'),
            ],
        ]);
    }
}
