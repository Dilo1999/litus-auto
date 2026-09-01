<?php

namespace Database\Seeders;

use App\Models\Showroom;
use Illuminate\Database\Seeder;

class ShowroomSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'name' => 'Malé Showroom',
                'address' => 'Chaandhanee Magu, Malé, Maldives',
                'phone' => '+960 779 7442',
                'services' => ['Sales', 'Service Centre', 'Parts'],
                'offers_pick_drop' => true,
                'pick_drop_label' => 'Malé',
                'is_featured' => true,
                'sort_order' => 1,
                'images' => [
                    "images/about_us/showrooms/Male' Showroom/Malé Showroom.jpg",
                    "images/about_us/showrooms/Male' Showroom/Male' Showroom1.webp",
                    "images/about_us/showrooms/Male' Showroom/Male' Showroom2.jpg",
                ],
            ],
            [
                'name' => 'Hithadhoo Showroom',
                'address' => 'Fenfiyazmagu, S. Hithadhoo, Maldives',
                'phone' => '+960 779 7444',
                'services' => ['Sales', 'Service Centre', 'Parts'],
                'is_featured' => true,
                'sort_order' => 2,
                'images' => [
                    'images/about_us/showrooms/Hithadhoo Showroom/Hithadhoo Showroom.jpg',
                    'images/about_us/showrooms/Hithadhoo Showroom/Hithadhoo Showroom1.jpg',
                    'images/about_us/showrooms/Hithadhoo Showroom/Hithadhoo Showroom2.jpg',
                ],
            ],
            [
                'name' => 'Kudahuvadhoo Showroom',
                'address' => 'Izzudheen Magu, Dh. Kudahuvadhoo, Maldives',
                'phone' => '+960 779 7442',
                'services' => ['Sales', 'Parts'],
                'is_featured' => false,
                'sort_order' => 3,
                'images' => [
                    'images/about_us/showrooms/Kudahuvadhoo Showroom/Kudahuvadhoo Showroom.jpg',
                    'images/about_us/showrooms/Kudahuvadhoo Showroom/Kudahuvadhoo Showroom1.jpg',
                ],
            ],
            [
                'name' => 'Naifaru Showroom',
                'address' => 'Ifthithaahee Magu, Lh. Naifaru, Maldives',
                'phone' => '+960 779 7442',
                'services' => ['Sales', 'Parts'],
                'is_featured' => false,
                'sort_order' => 4,
                'images' => [
                    'images/about_us/showrooms/Naifaru Showroom/Naifaru Showroom.webp',
                ],
            ],
            [
                'name' => 'Villingili Showroom',
                'address' => 'Ameenee Magu, GA. Villingili, Maldives',
                'phone' => '+960 779 7442',
                'services' => ['Sales', 'Parts'],
                'is_featured' => false,
                'sort_order' => 5,
                'images' => [
                    'images/about_us/showrooms/Villingili Showroom/Villingili Showroom.jpg',
                    'images/about_us/showrooms/Villingili Showroom/Villingili Showroom1.jpg',
                    'images/about_us/showrooms/Villingili Showroom/Villingili Showroom2.jpg',
                ],
            ],
            [
                'name' => 'Feydhoo Showroom',
                'address' => 'Maathila Magu, S. Feydhoo, Maldives',
                'phone' => '+960 779 7442',
                'services' => ['Sales', 'Parts'],
                'is_featured' => false,
                'sort_order' => 6,
                'images' => [
                    'images/about_us/showrooms/Feydhoo Showroom/Feydhoo Showroom.jpg',
                ],
            ],
            [
                'name' => 'Fonadhoo Showroom',
                'address' => 'Sinajuddeen Magu, L. Fonadhoo, Maldives',
                'phone' => '+960 779 7446',
                'services' => ['Sales', 'Parts'],
                'is_featured' => false,
                'sort_order' => 7,
                'images' => [
                    'images/about_us/showrooms/Fonadhoo Showroom/Fonadhoo Showroom.jpg',
                    'images/about_us/showrooms/Fonadhoo Showroom/Fonadhoo Showroom1.jpg',
                    'images/about_us/showrooms/Fonadhoo Showroom/Fonadhoo Showroom2.jpg',
                ],
            ],
            [
                'name' => 'Head Office',
                'address' => 'Ma. Eyrum, Buruzu Magu, Malé, Maldives',
                'phone' => '+960 779 7442',
                'services' => ['Sales', 'Support'],
                'is_featured' => false,
                'sort_order' => 8,
                'images' => [
                    'images/about_us/showrooms/Head Office/Head Office.webp',
                ],
            ],
            [
                'name' => 'Hulhumale Showroom',
                'address' => 'Nirolhu Magu, Hulhumale, Maldives',
                'phone' => '+960 779 7443',
                'services' => ['Sales', 'Parts'],
                'offers_pick_drop' => true,
                'pick_drop_label' => 'Hulhumalé',
                'is_featured' => false,
                'sort_order' => 9,
                'images' => [
                    'images/about_us/showrooms/Hulhumale Showroom/Hulhumale Showroom.webp',
                    'images/about_us/showrooms/Hulhumale Showroom/Hulhumale Showroom1.webp',
                    'images/about_us/showrooms/Hulhumale Showroom/Hulhumale Showroom2.webp',
                ],
            ],
            [
                'name' => 'Thinadhoo Showroom',
                'address' => 'Avenue Magu, Thinadhoo, Maldives',
                'phone' => '+960 779 7442',
                'services' => ['Sales', 'Parts'],
                'is_featured' => false,
                'sort_order' => 10,
                'images' => [
                    'images/about_us/showrooms/Thinadhoo Showroom/Thinadhoo Showroom.webp',
                    'images/about_us/showrooms/Thinadhoo Showroom/Thinadhoo Showroom1.webp',
                    'images/about_us/showrooms/Thinadhoo Showroom/Thinadhoo Showroom2.webp',
                ],
            ],
        ];

        foreach ($rows as $row) {
            Showroom::query()->updateOrCreate(
                ['name' => $row['name']],
                array_merge($row, ['is_published' => true])
            );
        }
    }
}
