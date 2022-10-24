<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreationCreationGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('creation_creation_group')->truncate();

        // for ($i=1; $i <= 8; $i++) { 
        //     DB::connection('mysql')->table('creation_creation_group')->insert([
        //         'creation_id' => $i,
        //         'creation_group_id' => rand(1, 4),
        //     ]);
        // }
        // for ($i=9; $i <= 11; $i++) { 
        //     DB::connection('mysql')->table('creation_creation_group')->insert([
        //         'creation_id' => $i,
        //         'creation_group_id' => 6,
        //     ]);
        // }
        // for ($i=1; $i <= 5; $i++) { 
        //     DB::connection('mysql')->table('creation_creation_group')->insert([
        //         'creation_id' => rand(1, 11),
        //         'creation_group_id' => 5,
        //     ]);
        // }

        // DB::connection('mysql')->table('creation_creation_group')->insert([
        //     'creation_id' => 12,
        //     'creation_group_id' => 3,
        // ]);
        
    }
}
