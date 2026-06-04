<?php

namespace Database\Seeders;

use App\Models\Testament;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestamentSeeder extends Seeder
{
    public function run(): void
    {
        Testament::create(['name' => 'Velho Testamento']);
        Testament::create(['name' => 'Novo Testamento']);
    }
}
