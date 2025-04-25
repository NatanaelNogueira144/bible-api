<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $csvFile = fopen(base_path('database/data/books.csv'), 'r');
        $firstline = true;
        while(($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            if(!$firstline) {
                Book::create([
                    'testament_id' => $data[1],
                    'name' => $data[2],
                    'abbrev' => $data[3]
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
