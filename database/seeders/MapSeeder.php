<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Map;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Mirage','describtion' => 'Map the Mirage'],
            ['name' => 'Nuke', 'describtion' => 'Map the Nuke'],
            ['name' => 'Anubis', 'describtion' => 'Map the Anubis'],
            ['name' => 'Ancient', 'describtion' => 'Map the Ancient'],
            ['name' => 'Overpass', 'describtion' => 'Map the Overpass'],
            ['name' => 'Inferno', 'describtion' => 'Map the Inferno'],
            ['name' => 'Vertigo', 'describtion' => 'Map the Vertigo'],
        ];  
        Map::insert($data);
    }
}
