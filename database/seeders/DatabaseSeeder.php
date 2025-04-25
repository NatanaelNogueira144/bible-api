<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(TestamentSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(A21VerseSeeder::class);
        $this->call(AAVerseSeeder::class);
        $this->call(ACFVerseSeeder::class);
        $this->call(ARAVerseSeeder::class);
        $this->call(ARCVerseSeeder::class);
        $this->call(KJAVerseSeeder::class);
        $this->call(NTLHVerseSeeder::class);
        $this->call(NVIVerseSeeder::class);
        $this->call(NVTVerseSeeder::class);
        $this->call(ReadingPlanSeeder::class);
        $this->call(ReadingPlanDaySeeder::class);
    }
}
