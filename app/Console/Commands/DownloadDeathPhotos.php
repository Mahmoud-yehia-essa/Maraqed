<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DownloadDeathPhotos extends Command
{
    protected $signature = 'photos:download';
    protected $description = 'Download DeathPhoto images from a JSON list';

    public function handle()
    {
        // Simulate the JSON (or load from file/db/api)
        $data = json_decode(file_get_contents(storage_path('app/deaths.json')), true);

        // Set the base URL where the images are hosted
        $baseUrl = 'https://jaafaryacemetery.nader-marafie.com/uploads/Tombs/'; // ← Replace this

        // Folder to save images
        $savePath = public_path('death_photos');
        if (!file_exists($savePath)) {
            mkdir($savePath, 0777, true);
        }

        foreach ($data as $item) {
            $photos = array_filter([
                $item['DeathPhoto'] ?? null,
                // $item['Photo2'] ?? null
            ]);

            foreach ($photos as $photo) {
                $url = $baseUrl . $photo;
                $filePath = $savePath . '/' . $photo;

                try {
                    $response = Http::timeout(10000)->get($url);
                    if ($response->successful()) {
                        file_put_contents($filePath, $response->body());
                        $this->info("Downloaded: $photo");
                    } else {
                        $this->error("Failed to download: $photo");
                    }
                } catch (\Exception $e) {
                    $this->error("Error downloading $photo: " . $e->getMessage());
                }
            }
        }

        $this->info("✅ All available images downloaded.");
    }
}
