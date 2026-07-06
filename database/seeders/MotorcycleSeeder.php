<?php

namespace Database\Seeders;

use App\Models\Motorcycle;
use App\Models\MotorcycleColorVariant;
use Illuminate\Database\Seeder;

class MotorcycleSeeder extends Seeder
{
    public function run(): void
    {
        $specs = [
            ['label' => 'Engine Capacity', 'value' => '160cc'],
            ['label' => 'Fuel Type', 'value' => 'Gasoline'],
            ['label' => 'Carburation', 'value' => 'Fuel Injection'],
            ['label' => 'Brakes Front', 'value' => 'Disc - ABS'],
            ['label' => 'Brakes Rear', 'value' => 'Disc'],
            ['label' => 'Suspension Front', 'value' => 'Telescopic Fork'],
            ['label' => 'Wheels Front', 'value' => 'Cast'],
            ['label' => 'Wheels Rear', 'value' => 'Cast'],
            ['label' => 'Fuel Tank Capacity', 'value' => '8.1L'],
            ['label' => 'Ground Clearance', 'value' => '165 mm'],
            ['label' => 'Frame Type', 'value' => 'Double Cradle'],
            ['label' => 'Net Weight', 'value' => '134 kg'],
            ['label' => 'Seat Height', 'value' => '781 mm'],
            ['label' => 'Clutch', 'value' => 'Automatic Centrifugal Dry Clutch'],
            ['label' => 'Final Drive', 'value' => 'Belt'],
            ['label' => 'Transmission Type', 'value' => 'Automatic CVT Transmission'],
        ];

        $spinFrames = [
            'images/360/download.png',
            'images/360/download (1).png',
            'images/360/download (2).png',
            'images/360/download (3).png',
            'images/360/download (4).png',
        ];

        $motorcycle = Motorcycle::updateOrCreate(
            ['slug' => 'adv-160-2026'],
            [
                'name' => 'ADV 160 2026',
                'category' => 'Touring Bikes',
                'brand' => 'Honda',
                'original_price' => 111750,
                'sale_price' => 95000,
                'offer_label' => 'Limited Offer',
                'offer_note' => 'This offer valid for Green, Brown Colors.',
                'specs' => $specs,
                'hero_background' => 'images/motorcycles/details/ChatGPT Image Jul 4, 2026, 12_38_11 PM.png',
                'is_published' => true,
                'sort_order' => 1,
            ]
        );

        MotorcycleColorVariant::updateOrCreate(
            ['motorcycle_id' => $motorcycle->id, 'label' => 'Green'],
            [
                'hex_color' => '#2f3c1c',
                'spin_frames' => $spinFrames,
                'gallery_images' => [
                    'images/product/premium 125 blue.png',
                    'images/product/premium 125 red.png',
                    'images/product/special edition 125 green yellow.png',
                ],
                'is_default' => true,
                'sort_order' => 1,
            ]
        );

        MotorcycleColorVariant::updateOrCreate(
            ['motorcycle_id' => $motorcycle->id, 'label' => 'Brown'],
            [
                'hex_color' => '#5a3515',
                'spin_frames' => $spinFrames,
                'gallery_images' => [
                    'images/product/premium 125 red.png',
                    'images/product/premium 125 blue.png',
                    'images/product/special edition 125 green yellow.png',
                ],
                'is_default' => false,
                'sort_order' => 2,
            ]
        );
    }
}
