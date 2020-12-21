<?php

namespace Database\Seeders;

use App\Models\Bookable;
use App\Models\Image;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bookable::all()->each(function(Bookable $bookable){
            $images = Image::factory(rand(5,20))->make();
            $bookable->images()->saveMany($images);
        });
    }
}
