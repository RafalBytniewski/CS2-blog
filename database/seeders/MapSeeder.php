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
            ['name' => 'Mirage','describtion' => 'Map the Mirage','active' => 1, 'image_path' => ''],
            ['name' => 'Nuke', 'describtion' => 'Map the Nuke','active' => 1], 'image_path' => '',
            ['name' => 'Anubis', 'describtion' => 'Map the Anubis','active' => 1, 'image_path' => ''],
            ['name' => 'Ancient', 'describtion' => 'Map the Ancient','active' => 1, 'image_path' => ''],
            ['name' => 'Overpass', 'describtion' => 'Map the Overpass','active' => 0, 'image_path' => ''],
            ['name' => 'Inferno', 'describtion' => 'Map the Inferno','active' => 1, 'image_path' => ''],
            ['name' => 'Vertigo', 'describtion' => 'Map the Vertigo','active' => 1, 'image_path' => ''],
            ['name' => 'Dust 2', 'describtion' => 'Map the Dust 2','active' => 1, 'image_path' => ''],
            ['name' => 'Office', 'describtion' => 'Map the Office','active' => 0, 'image_path' => ''],
            ['name' => 'Italy', 'describtion' => 'Map the Italy','active' => 0, 'image_path' => '']
        ];  
        Map::insert($data);
    }
}
