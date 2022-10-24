<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('shops')->delete();

        DB::connection('mysql')->table('shops')->insert([
            'name' => "BENU VILLAGE Esch Asbl",
            'type' => "BENU owned",
            'description_fr' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ipsum neque, mollis a mauris sit amet, condimentum ullamcorper tortor. Donec vel ligula imperdiet ex fermentum finibus ac in nunc. Ut quis commodo nec vel ligula imperdiet ex fermentum finib.",
            'description_en' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ipsum neque, mollis a mauris sit amet, condimentum ullamcorper tortor. Donec vel ligula imperdiet ex fermentum finibus ac in nunc. Ut quis commodo nec vel ligula imperdiet ex fermentum finib.",
            'description_lu' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ipsum neque, mollis a mauris sit amet, condimentum ullamcorper tortor. Donec vel ligula imperdiet ex fermentum finibus ac in nunc. Ut quis commodo nec vel ligula imperdiet ex fermentum finib.",
            'description_de' => "shops.description-benu-village",
            'address' => "51 rue d'Audun, 4018 Esch-sur-Alzette, Luxembourg",
            'phone' => "+352 27 91 19 49",
            'website' => "www.benu.lu",
            'email' => 'email@gmail.com',
            //'opening_time' => "Du lundi au samedi, de 9h à 18h",
            'picture' => "benu_shop.png",
            'opening_monday' => "9h-12h / 13h-17h30",
            'opening_tuesday' => "9h-12h / 13h-18h",
            'opening_wednesday' => "9h-12h / 13h-18h",
            'opening_thursday' => "9h-12h / 13h-18h",
            'opening_friday' => "9h-12h / 13h-18h",
            'opening_saturday' => "9h-12h / 13h-18h",
            'filter_key' => 'benu-esch',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::connection('mysql')->table('shops')->insert([
            'name' => "Pop-up store Hamilius",
            'type' => "Pop-up",
            'description_fr' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ipsum neque, mollis a mauris sit amet, condimentum ullamcorper tortor. Donec vel ligula imperdiet ex fermentum finibus ac in nunc. Ut quis commodo nec vel ligula imperdiet ex fermentum finib.",
            'description_en' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ipsum neque, mollis a mauris sit amet, condimentum ullamcorper tortor. Donec vel ligula imperdiet ex fermentum finibus ac in nunc. Ut quis commodo nec vel ligula imperdiet ex fermentum finib.",
            'description_lu' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ipsum neque, mollis a mauris sit amet, condimentum ullamcorper tortor. Donec vel ligula imperdiet ex fermentum finibus ac in nunc. Ut quis commodo nec vel ligula imperdiet ex fermentum finib.",
            'description_de' => "shops.description-pop-up-hamilius",
            'address' => "Place Hamilius, Luxembourg, Luxembourg",
            'phone' => "+xxx xx xx xx xx",
            'website' => "www.xxxx.lu",
            'email' => 'email@gmail.com',
            //'opening_time' => "Du lundi au vendredi, de 9h à 18h",
            'picture' => "popup_store_1.png",
            'opening_monday' => "9h-12h / 13h-17h30",
            'opening_tuesday' => "9h-12h / 13h-18h",
            'opening_wednesday' => "9h-12h / 13h-18h",
            'opening_thursday' => "9h-12h / 13h-18h",
            'opening_friday' => "9h-12h / 13h-18h",
            'opening_saturday' => "9h-12h / 13h-18h",
            'filter_key' => 'pop-up-hamilius',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::connection('mysql')->table('shops')->insert([
            'name' => "Pop-up store 2",
            'type' => "Pop-up",
            'description_fr' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ipsum neque, mollis a mauris sit amet, condimentum ullamcorper tortor. Donec vel ligula imperdiet ex fermentum finibus ac in nunc. Ut quis commodo nec vel ligula imperdiet ex fermentum finib.",
            'description_en' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ipsum neque, mollis a mauris sit amet, condimentum ullamcorper tortor. Donec vel ligula imperdiet ex fermentum finibus ac in nunc. Ut quis commodo nec vel ligula imperdiet ex fermentum finib.",
            'description_lu' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ipsum neque, mollis a mauris sit amet, condimentum ullamcorper tortor. Donec vel ligula imperdiet ex fermentum finibus ac in nunc. Ut quis commodo nec vel ligula imperdiet ex fermentum finib.",
            'description_de' => "shops.description-pop-up-2",
            'address' => "XX rue de XX, Ville, Pays",
            'phone' => "+xxx xx xx xx xx",
            'website' => "www.xxxx.lu",
            'email' => 'email@gmail.com',
            //'opening_time' => "Du lundi au vendredi, de 9h à 18h",
            'picture' => "popup_store_2.png",
            'opening_monday' => "9h-12h / 13h-17h30",
            'opening_tuesday' => "9h-12h / 13h-18h",
            'opening_wednesday' => "9h-12h / 13h-18h",
            'opening_thursday' => "9h-12h / 13h-18h",
            'opening_friday' => "9h-12h / 13h-18h",
            'opening_saturday' => "9h-12h / 13h-18h",
            'filter_key' => 'pop-up-2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
