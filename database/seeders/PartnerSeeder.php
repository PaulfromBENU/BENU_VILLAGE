<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('partners')->truncate();

        // for ($i=0; $i < 4; $i++) { 
        //     DB::connection('mysql')->table('partners')->insert([
        //         'name' => "Repair Café",
        //         'picture' => "repair_cafe.png",
        //         'description_de' => "partner.desc-partnername",
        //         'description_lu' => "Une description de ce partenaire, en langue allemande.",
        //         'description_en' => "Une description de ce partenaire, en langue allemande.",
        //         'description_fr' => "Repair Café Lëtzebuerg organise des Repair Cafés. Ce sont des réunions volontaires où les participants travaillent ensemble pour réparer leurs objets cassés: petits appareils électriques, vêtements, vélos, jouets, petits meubles et bien plus encore.",
        //         'address' => "34, rue Josy Welter, 7256 Walferdange",
        //         'phone' => "+352 26 33 28 19",
        //         'email' => "repaircafe@cell.lu",
        //         'website' => "www.repaircafe.lu",
        //         'filter_key' => 'repair-cafe',
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     ]);
        // }
    }
}
