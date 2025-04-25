<?php

namespace Database\Seeders;

use App\Models\ReadingPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReadingPlanSeeder extends Seeder
{
    public function run(): void
    {
        ReadingPlan::create(['name' => 'Leitura da Bíblia em 1 Ano']);
    }
}
