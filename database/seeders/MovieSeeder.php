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
                'poster' => '/storage/photos/1/poster/justice league poster.jpg',
                'banner' => 'https://asset-a.grid.id/crop/0x0:0x0/x/photo/2021/03/06/img_20210306_115058jpg-20210306121159.jpg',
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
                'poster' => '/storage/photos/1/poster/black widow poster.jpg',
                'banner' => 'https://nawacita.co/wp-content/uploads/2021/09/Black-Widow.jpg',
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
                'poster' => '/storage/photos/1/poster/endgame poster.jpg',
                'banner' => 'https://static1.cbrimages.com/wordpress/wp-content/uploads/2019/04/Avengers-Endgame-banner-poster.jpg',
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
                'poster' => '/storage/photos/1/poster/gotg vol 2 poster.jpg',
                'banner' => 'https://asset.winnetnews.com/image/cache/slide/post/image-wihh-keren-baru-tayang-seminggu-guardians-of-the-galaxy-vol-2-dapat-1-9-triliun.jpg',
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
                'poster' => '/storage/photos/1/poster/gotg vol 1 poster.jpg',
                'banner' => 'https://w0.peakpx.com/wallpaper/976/695/HD-wallpaper-movie-guardians-of-the-galaxy-drax-the-destroyer-gamora-groot-rocket-raccoon-star-lord.jpg',
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
                'poster' => '/storage/photos/1/poster/ant man poster.jpg',
                'banner' => 'https://i0.wp.com/www.heyuguys.com/images/2015/06/Ant-Man-Banner.jpg?fit=1024%2C512&ssl=1',
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
