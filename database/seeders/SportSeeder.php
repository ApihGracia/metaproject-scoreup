<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Sport;

class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     //
    // }

    public function run()
    {
        Sport::create(['name' => 'Football']);
        Sport::create(['name' => 'Basketball']);
        Sport::create(['name' => 'Tennis']);
    }
}
