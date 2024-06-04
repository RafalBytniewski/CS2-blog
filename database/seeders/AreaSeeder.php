<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $areas = [
            ['map_id' => 1, 'name' => 'Ct'],
            ['map_id' => 1, 'name' => 'T'],
            ['map_id' => 1, 'name' => 'Mid'],
            ['map_id' => 1, 'name' => 'A'],
            ['map_id' => 1, 'name' => 'B'],
            ['map_id' => 2, 'name' => 'Ct'],
            ['map_id' => 2, 'name' => 'T'],
            ['map_id' => 2, 'name' => 'Mid'],
            ['map_id' => 2, 'name' => 'A'],
            ['map_id' => 2, 'name' => 'B'],
            ['map_id' => 3, 'name' => 'Ct'],
            ['map_id' => 3, 'name' => 'T'],
            ['map_id' => 3, 'name' => 'Mid'],
            ['map_id' => 3, 'name' => 'A'],
            ['map_id' => 3, 'name' => 'B'],
            ['map_id' => 4, 'name' => 'Ct'],
            ['map_id' => 4, 'name' => 'T'],
            ['map_id' => 4, 'name' => 'Mid'],
            ['map_id' => 4, 'name' => 'A'],
            ['map_id' => 4, 'name' => 'B'],
            ['map_id' => 5, 'name' => 'Ct'],
            ['map_id' => 5, 'name' => 'T'],
            ['map_id' => 5, 'name' => 'Mid'],
            ['map_id' => 5, 'name' => 'A'],
            ['map_id' => 5, 'name' => 'B'],
            ['map_id' => 6, 'name' => 'Ct'],
            ['map_id' => 6, 'name' => 'T'],
            ['map_id' => 6, 'name' => 'Mid'],
            ['map_id' => 6, 'name' => 'A'],
            ['map_id' => 6, 'name' => 'B'],
            ['map_id' => 7, 'name' => 'Ct'],
            ['map_id' => 7, 'name' => 'T'],
            ['map_id' => 7, 'name' => 'Mid'],
            ['map_id' => 7, 'name' => 'A'],
            ['map_id' => 7, 'name' => 'B'],
            ['map_id' => 8, 'name' => 'Ct'],
            ['map_id' => 8, 'name' => 'T'],
            ['map_id' => 8, 'name' => 'Mid'],
            ['map_id' => 8, 'name' => 'A'],
            ['map_id' => 8, 'name' => 'B'],
            ['map_id' => 9, 'name' => 'Ct'],
            ['map_id' => 9, 'name' => 'T'],
            ['map_id' => 9, 'name' => 'Mid'],
            ['map_id' => 9, 'name' => 'A'],
            ['map_id' => 9, 'name' => 'B'],
            ['map_id' => 10, 'name' => 'Ct'],
            ['map_id' => 10, 'name' => 'T'],
            ['map_id' => 10, 'name' => 'Mid'],
            ['map_id' => 10, 'name' => 'A'],
            ['map_id' => 10, 'name' => 'B'],
        ];

        DB::table('areas')->insert($areas);
    }
}
