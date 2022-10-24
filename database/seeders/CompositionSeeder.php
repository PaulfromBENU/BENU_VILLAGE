<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('compositions')->delete();
        
        $fabric_options_en = ['cotton', 'wool', 'polyester', 'linen', 'silk'];
        $fabric_options_fr = ['coton', 'laine', 'polyester', 'lin', 'soie'];
        $fabric_options_lu = ['cotton-lu', 'wool-lu', 'polyester-lu', 'linen-lu', 'silk-lu'];
        $fabric_options_de = ['fabric.cotton', 'fabric.wool', 'fabric.polyester', 'fabric.linen', 'fabric.silk'];

        for ($i=0; $i < 5; $i++) { 
            DB::connection('mysql')->table('compositions')->insert([
                'fabric_lu' => $fabric_options_lu[$i],
                'fabric_en' => $fabric_options_en[$i],
                'fabric_fr' => $fabric_options_fr[$i],
                'fabric_de' => $fabric_options_de[$i],
                'explanation_lu' => 'Une explication sur la matiere en luxembourgeois',
                'explanation_fr' => 'Une explication sur la matiere en français',
                'explanation_de' => 'fabric.explanation-'.$fabric_options_fr[$i],
                'explanation_en' => 'Une explication sur la matiere en anglais',
                'picture' => 'cotton.jpg',
            ]);
        }
    }
}
