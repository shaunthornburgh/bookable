<?php

namespace Database\Seeders;

use Spatie\Tags\Tag;
use App\Models\Bookable;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class BookablesTableSeeder extends Seeder
{
    private $images_from_unsplash = [
        'https://images.unsplash.com/photo-1612320648993-61c1cd604b71?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2072&q=80',
        'https://images.unsplash.com/photo-1600210492493-0946911123ea?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80',
        'https://images.unsplash.com/photo-1601628828688-632f38a5a7d0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1009&q=80',
        'https://images.unsplash.com/photo-1554995207-c18c203602cb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80',
        'https://images.unsplash.com/photo-1631679706909-1844bbd07221?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1392&q=80',
        'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80',
        'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80',
        'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1700&q=80',
    ];

    private $amenities = [
        'Balcony',
        'Pool',
        'Beach',
        'Pet friendly',
        'Kid friendly',
        'Parking',
        'Air conditioning',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookables = Bookable::factory()
            ->times(30)
            ->create();
        
        $tags = collect();

        foreach($this->amenities as $amenity){
            $tags->push(Tag::findOrCreate( $amenity, 'amenities'));
        }

        foreach($bookables as $bookable){
            $bookable
            ->addMediaFromUrl(Arr::random($this->images_from_unsplash))
            ->toMediaCollection('picture');

            $bookable
            ->addMediaFromUrl(Arr::random($this->images_from_unsplash))
            ->toMediaCollection('gallery');

            $bookable
            ->addMediaFromUrl(Arr::random($this->images_from_unsplash))
            ->toMediaCollection('gallery');

            $bookable
            ->addMediaFromUrl(Arr::random($this->images_from_unsplash))
            ->toMediaCollection('gallery');

            $bookable->attachTag($tags->random());
            $bookable->attachTag($tags->random());
            $bookable->attachTag($tags->random());
            $bookable->attachTag($tags->random());

        }

    }
}
