<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('photos')->delete();
        
        $filename_options = ['modele_caretta_1.png', 'modele_2.png', 'modele_3.png', 'modele_4.png', 'modele_5.png'];

        // for ($i=0; $i < 5; $i++) { 
        //     DB::connection('mysql')->table('photos')->insert([
        //         'file_name' => $filename_options[$i],
        //         'use_for_model' => '1',
        //         'title' => "Article Picture",
        //         'author' => "BENU Village Esch Asbl",
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     ]);
        // }
    }
}
