<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreationGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('creation_groups')->delete();

        DB::connection('mysql')->table('creation_groups')->insert([
            'name_fr' => 'Unisex',
            'name_en' => 'Unisex',
            'name_lu' => 'Unisex Lu',
            'name_de' => 'type.unisex',
            'filter_key' => 'unisex',
        ]);

        DB::connection('mysql')->table('creation_groups')->insert([
            'name_fr' => 'Dames',
            'name_en' => 'Ladies',
            'name_lu' => 'Ladies Lu',
            'name_de' => 'type.ladies',
            'filter_key' => 'ladies',
        ]);

        DB::connection('mysql')->table('creation_groups')->insert([
            'name_fr' => 'Messieurs',
            'name_en' => 'Gentlemen',
            'name_lu' => 'Messieurs Lu',
            'name_de' => 'type.gentlemen',
            'filter_key' => 'gentlemen',
        ]);

        DB::connection('mysql')->table('creation_groups')->insert([
            'name_fr' => 'Enfants',
            'name_en' => 'Kids',
            'name_lu' => 'Kids Lu',
            'name_de' => 'type.kids',
            'filter_key' => 'kids',
        ]);

        DB::connection('mysql')->table('creation_groups')->insert([
            'name_fr' => 'Accessoires',
            'name_en' => 'Accessories',
            'name_lu' => 'Accessories Lu',
            'name_de' => 'type.accessories',
            'filter_key' => 'accessories',
        ]);

        DB::connection('mysql')->table('creation_groups')->insert([
            'name_fr' => 'Maison',
            'name_en' => 'Home',
            'name_lu' => 'Home Lu',
            'name_de' => 'type.home',
            'filter_key' => 'home',
        ]);

        DB::connection('mysql')->table('creation_groups')->insert([
            'name_fr' => "Bon d'achat",
            'name_en' => 'Voucher',
            'name_lu' => 'Voucher Lu',
            'name_de' => 'type.voucher',
            'filter_key' => 'voucher',
        ]);
    }
}
