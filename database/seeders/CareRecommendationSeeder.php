<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CareRecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('care_recommendations')->delete();
        
        $name_options = ['ironing', 'washing', 'drying'];
        $picture_options = ['services_care_1', 'services_care_2', 'services_care_3'];

        for ($i=0; $i < 3; $i++) { 
            DB::connection('mysql')->table('care_recommendations')->insert([
                'name' => $name_options[$i],
                'description_de' => 'care.description-'.$name_options[$i],
                'description_fr' => 'Ici une description en français',
                'description_lu' => 'Ici une description en luxembourgeois',
                'description_en' => 'Ici une description en anglais',
                'picture' => $picture_options[array_rand($picture_options)],
            ]);
        }
    }
}
