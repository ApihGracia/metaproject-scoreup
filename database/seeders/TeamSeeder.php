<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $teams = [
            ['name' => 'KAHS', 'description' => null, 'photo' => null],
            ['name' => 'KUO', 'description' => null, 'photo' => null],
            ['name' => 'KHAR', 'description' => null, 'photo' => null],
            ['name' => 'KZ', 'description' => null, 'photo' => null],
            ['name' => 'KAB', 'description' => null, 'photo' => null],
            ['name' => 'UKLK', 'description' => null, 'photo' => null],
        ];

        foreach ($teams as $team) {
            Team::firstOrCreate(['name' => $team['name']], $team);
        }
    }
}