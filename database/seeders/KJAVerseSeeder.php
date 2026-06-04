<?php

namespace Database\Seeders;

use App\Models\Verse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KJAVerseSeeder extends Seeder
{
    public function run(): void
    {
        $csvFile = fopen(base_path('database/data/verses-kja.csv'), 'r');
        $firstline = true;
        while(($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            if(!$firstline) {
                Verse::create([
                    'testament_id' => $data[1],
                    'book_id' => $data[2],
                    'version' => $data[3],
                    'chapter' => $data[4],
                    'verse' => $data[5],
                    'text' => $data[6]
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
