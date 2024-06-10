<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Callouts;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['area_id' => 2, 'name' => 'Roof'],
            ['area_id' => 2, 'name' => 'In front of ramp'],
            ['area_id' => 2, 'name' => 'Stairs'],
            ['area_id' => 2, 'name' => 'Apps ramp'],
            ['area_id' => 3, 'name' => 'Top mid'],
            ['area_id' => 3, 'name' => 'Under window'],
            ['area_id' => 3, 'name' => 'Boxes'],
            ['area_id' => 3, 'name' => 'Catwalk'],
            ['area_id' => 3, 'name' => 'Short'],
            ['area_id' => 3, 'name' => 'Ladder room'],
            ['area_id' => 3, 'name' => 'Window'],
            ['area_id' => 3, 'name' => 'Connector'],
            ['area_id' => 3, 'name' => 'Chair'],
            ['area_id' => 4, 'name' => 'Fire box'],
            ['area_id' => 4, 'name' => 'Default'],
            ['area_id' => 4, 'name' => 'Ct/Ticket box'],
            ['area_id' => 4, 'name' => 'Ninja'],
            ['area_id' => 4, 'name' => 'Second ninja'],
            ['area_id' => 4, 'name' => 'Site'],
            ['area_id' => 4, 'name' => 'Wood'],
            ['area_id' => 4, 'name' => 'Under wood'],
            ['area_id' => 4, 'name' => 'Balcony'],
            ['area_id' => 4, 'name' => 'Ramp'],
            ['area_id' => 4, 'name' => 'Pillars'],
            ['area_id' => 4, 'name' => 'Tetris'],
            ['area_id' => 4, 'name' => 'Stairs'],
            ['area_id' => 4, 'name' => 'Top connector'],
            ['area_id' => 4, 'name' => 'Jungle'],
            ['area_id' => 5, 'name' => 'Kitchen door/Exit'],
            ['area_id' => 5, 'name' => 'Kitchen window'],
            ['area_id' => 5, 'name' => 'Bench'],
            ['area_id' => 5, 'name' => 'Default'],
            ['area_id' => 5, 'name' => 'Site'],
            ['area_id' => 5, 'name' => 'Edward'],
            ['area_id' => 5, 'name' => 'Short'],
            ['area_id' => 5, 'name' => 'Balcony'],
            ['area_id' => 5, 'name' => 'Apartments'],
            ['area_id' => 3, 'name' => 'Underground'],
            ['area_id' => 3, 'name' => 'Start'],
            ['area_id' => 4, 'name' => 'Jungle/connector'],
            ['area_id' => 1, 'name' => 'Spawn'],
            ['area_id' => 2, 'name' => 'Spawn'],
        ];
        Callouts::insert($data);
    }
}
