<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Movie;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                'name' => 'Godzilla',
                'slug' => 'godzilla',
                'category' => 'action',
                'video_url' => 'https://youtu.be/vIu85WQTPRc?si=r-VdS--mRDnU5yl5',
                'thumbnail' => 'https://assets1.ignimgs.com/2014/03/21/godzillaposter7jpg-0a56d0.jpg',
                'rating' => 3,
                'is_featured' => false,
            ],
            [
                'name' => 'The Godfather',
                'slug' => 'the-godfather',
                'category' => 'Crime',
                'video_url' => 'https://youtu.be/UaVTIH8mujA?si=Tb9jNQnFzv85gj9y',
                'thumbnail' => 'https://ntvb.tmsimg.com/assets/p6326_v_h8_be.jpg?w=960&h=540',
                'rating' => 4,
                'is_featured' => true,
            ],
            [
                'name' => 'The Godfather II',
                'slug' => 'the-godfather-ii',
                'category' => 'Crime',
                'video_url' => 'https://youtu.be/9O1Iy9od7-A?si=V5WReeUcM_zSOmJu',
                'thumbnail' => 'https://streamcoimg-a.akamaihd.net/000/390/616/390616-Banner-L2-55dd75731636ad6f10908d2ec9b23bd3.jpg',
                'rating' => 4,
                'is_featured' => true,
            ],
        ];

        Movie::insert($movies);
    }
}
