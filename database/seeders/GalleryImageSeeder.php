<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Seeder;

class GalleryImageSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'category' => GalleryImage::CATEGORY_MOTORCYCLES,
                'title' => null,
                'image' => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=900&q=80',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'category' => GalleryImage::CATEGORY_MOTORCYCLES,
                'title' => 'Grand Vibes',
                'image' => 'https://images.unsplash.com/photo-1777991412484-8fa8cb512e6b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80',
                'is_featured' => false,
                'sort_order' => 2,
            ],
            [
                'category' => GalleryImage::CATEGORY_MOTORCYCLES,
                'title' => 'Coastal Cruising',
                'image' => 'https://images.unsplash.com/photo-1588756681780-9d5859fc2ca0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80',
                'is_featured' => false,
                'sort_order' => 3,
            ],
            [
                'category' => GalleryImage::CATEGORY_MOTORCYCLES,
                'title' => 'Ready to Ride',
                'image' => 'https://images.unsplash.com/photo-1550149550-33b46c745e03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80',
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'category' => GalleryImage::CATEGORY_MOTORCYCLES,
                'title' => 'Power & Precision',
                'image' => 'https://images.unsplash.com/photo-1601556402552-23ce8f2b31fc?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80',
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'category' => GalleryImage::CATEGORY_MOTORCYCLES,
                'title' => 'Sunset Trail',
                'image' => 'https://images.unsplash.com/photo-1558979159-2b18a4070a87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80',
                'is_featured' => false,
                'sort_order' => 6,
            ],
            [
                'category' => GalleryImage::CATEGORY_SHOWROOMS,
                'title' => 'LITUS Showroom, Malé',
                'image' => 'https://images.unsplash.com/photo-1560472355-536de3962603?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'category' => GalleryImage::CATEGORY_SHOWROOMS,
                'title' => 'Premium Display',
                'image' => 'https://images.unsplash.com/photo-1676246751280-16f3d4d0db7a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80',
                'is_featured' => false,
                'sort_order' => 2,
            ],
            [
                'category' => GalleryImage::CATEGORY_SHOWROOMS,
                'title' => 'Showroom Floor',
                'image' => 'https://images.unsplash.com/photo-1692201841147-3c1c5f87cb05?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80',
                'is_featured' => false,
                'sort_order' => 3,
            ],
            [
                'category' => GalleryImage::CATEGORY_CUSTOMER_MOMENTS,
                'title' => 'Ride with Confidence',
                'image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=700&q=80',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'category' => GalleryImage::CATEGORY_CUSTOMER_MOMENTS,
                'title' => 'Happy Riders',
                'image' => 'https://images.unsplash.com/photo-1598077737122-925e6f7cf137?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80',
                'is_featured' => false,
                'sort_order' => 2,
            ],
            [
                'category' => GalleryImage::CATEGORY_CUSTOMER_MOMENTS,
                'title' => 'Family Ride Day',
                'image' => 'https://images.unsplash.com/photo-1683914791874-3d7cd42e2543?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80',
                'is_featured' => false,
                'sort_order' => 3,
            ],
            [
                'category' => GalleryImage::CATEGORY_CUSTOMER_MOMENTS,
                'title' => 'Delivery Ready',
                'image' => 'https://images.unsplash.com/photo-1629342651203-fab0990d8949?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80',
                'is_featured' => false,
                'sort_order' => 4,
            ],
        ];

        foreach ($items as $item) {
            GalleryImage::query()->updateOrCreate(
                [
                    'category' => $item['category'],
                    'image' => $item['image'],
                ],
                [
                    'title' => $item['title'],
                    'is_featured' => $item['is_featured'],
                    'is_published' => true,
                    'sort_order' => $item['sort_order'],
                ]
            );
        }
    }
}
