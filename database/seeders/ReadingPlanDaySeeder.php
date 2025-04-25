<?php

namespace Database\Seeders;

use App\Models\ReadingPlanDay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReadingPlanDaySeeder extends Seeder
{
    public function run(): void
    {
        $csvFile = fopen(base_path('database/data/reading-plan-days.csv'), 'r');
        $firstline = true;
        while(($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            if(!$firstline) {
                ReadingPlanDay::create([
                    'reading_plan_id' => $data[0],
                    'day' => $data[1],
                    'book_id' => $data[2],
                    'chapter' => $data[3],
                    'first_verse' => $data[4] ?: null,
                    'last_verse' => $data[5] ?: null
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
