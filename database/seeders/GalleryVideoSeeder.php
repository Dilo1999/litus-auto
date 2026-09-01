<?php

namespace Database\Seeders;

use App\Models\GalleryVideo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class GalleryVideoSeeder extends Seeder
{
    public function run(): void
    {
        $videos = [
            'https://www.tiktok.com/@litus.automobiles/video/7496836349077523719',
            'https://www.tiktok.com/@litus.automobiles/video/7660491762992942344',
            'https://www.tiktok.com/@litus.automobiles/video/7660407464843545863',
            'https://www.tiktok.com/@litus.automobiles/video/7653814327799008520',
            'https://www.tiktok.com/@litus.automobiles/video/7647059001359846674',
        ];

        foreach ($videos as $index => $url) {
            $videoId = GalleryVideo::extractTikTokVideoId($url);
            $thumbnail = null;

            if ($videoId) {
                $legacyThumb = public_path('images/gallery/tiktok/'.$videoId.'.jpg');

                if (is_file($legacyThumb)) {
                    $storagePath = 'gallery/videos/'.$videoId.'.jpg';
                    Storage::disk('public')->put($storagePath, file_get_contents($legacyThumb));
                    $thumbnail = $storagePath;
                }
            }

            GalleryVideo::query()->updateOrCreate(
                ['video_url' => $url],
                [
                    'title' => null,
                    'thumbnail' => $thumbnail,
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
