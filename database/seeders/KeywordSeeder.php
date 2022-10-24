<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('keywords')->delete();
        
        $keyword_options = ['élegance', 'légèreté', 'résistance', 'chaleur'];

        for ($i=0; $i < 4; $i++) { 
            DB::connection('mysql')->table('keywords')->insert([
                'keyword_fr' => $keyword_options[$i],
                'keyword_en' => $keyword_options[$i],
                'keyword_lu' => $keyword_options[$i],
                'keyword_de' => 'keywords.keyword-name',
            ]);
        }
        for ($i=0; $i < 15; $i++) { 
            DB::connection('mysql')->table('keywords')->insert([
                'keyword_fr' => 'other-keyword-'.$i,
                'keyword_en' => 'other-keyword-'.$i,
                'keyword_lu' => 'other-keyword-'.$i,
                'keyword_de' => 'keywords.keyword-name',
            ]);
        }

        DB::connection('mysql')->table('keywords')->insert([
            'keyword_fr' => 'a-keyword',
            'keyword_en' => 'a-keyword',
            'keyword_lu' => 'Aus geupcyclte Kotténgskleedungsstécker',
            'keyword_de' => 'a-keyword',
        ]);
        DB::connection('mysql')->table('keywords')->insert([
            'keyword_fr' => 'a-keyword',
            'keyword_en' => 'a-keyword',
            'keyword_lu' => 'Ronnen Halsauschnëtt',
            'keyword_de' => 'a-keyword',
        ]);
        DB::connection('mysql')->table('keywords')->insert([
            'keyword_fr' => 'a-keyword',
            'keyword_en' => 'a-keyword',
            'keyword_lu' => 'Hält op der Hëft op',
            'keyword_de' => 'a-keyword',
        ]);
        DB::connection('mysql')->table('keywords')->insert([
            'keyword_fr' => 'a-keyword',
            'keyword_en' => 'a-keyword',
            'keyword_lu' => 'Riichte Schnëtt',
            'keyword_de' => 'a-keyword',
        ]);
        DB::connection('mysql')->table('keywords')->insert([
            'keyword_fr' => 'a-keyword',
            'keyword_en' => 'a-keyword',
            'keyword_lu' => 'Patchwork vir an hannen',
            'keyword_de' => 'a-keyword',
        ]);
    }
}
