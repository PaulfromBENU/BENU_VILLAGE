<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreationAccessorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('creation_accessories')->delete();
        
        $name_options = ['Fancy zipper', 'Special button', 'Beautiful pocket', 'Superb laces', 'Amazing option'];
        $slugified_name_options = ['fancy-zipper', 'special-button', 'beautiful-pocket', 'superb-laces', 'amazing-option'];

        for ($i=0; $i < 5; $i++) { 
            DB::connection('mysql')->table('creation_accessories')->insert([
                'name' => $name_options[$i],
                'description_de' => "creation-accessory.desc-".$slugified_name_options[$i],
                'description_fr' => "Une description de l'accessoire, en langue française",
                'description_lu' => "Une description de l'accessoire, en langue luxembourgeoise",
                'description_en' => "Une description de l'accessoire, en langue anglaise",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
