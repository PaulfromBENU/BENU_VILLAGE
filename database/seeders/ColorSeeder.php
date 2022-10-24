<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('colors')->delete();

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'beige',
            'hex_code' => '#D1B1A0',
        ]);

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'black',
            'hex_code' => '#000000',
        ]);

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'blue',
            'hex_code' => '#6CB8FF',
        ]);

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'brown',
            'hex_code' => '#63421A',
        ]);

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'denim',
            'hex_code' => '#3C41B9',
        ]);

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'green',
            'hex_code' => '#27955B',
        ]);

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'grey',
            'hex_code' => '#8A8A88',
        ]);

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'multicolor',
            'hex_code' => '#27955B',
        ]);

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'orange',
            'hex_code' => '#F79614',
        ]);

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'pink',
            'hex_code' => '#FF9BFF',
        ]);

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'purple',
            'hex_code' => '#7321A7',
        ]);

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'red',
            'hex_code' => '#DD200D',
        ]);

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'velvet',
            'hex_code' => '#AA7FEB',
        ]);

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'white',
            'hex_code' => '#E7ECED',
        ]);

        DB::connection('mysql')->table('colors')->insert([
            'name' => 'yellow',
            'hex_code' => '#E7EC10',
        ]);

        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'green',
        //     'hex_code' => '#27955B',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'red',
        //     'hex_code' => '#D41C1B',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'grey',
        //     'hex_code' => '#a1b2cf',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'purple',
        //     'hex_code' => '#793162',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'brown',
        //     'hex_code' => '#64422C',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'blue',
        //     'hex_code' => '#0079A7',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'orange',
        //     'hex_code' => '#FF9300',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'yellow',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'beige',
        //     'hex_code' => '#000000',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'black',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'bordeaux',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'brownish',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'darkblue',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'darkgrey',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'darkred',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'jean',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'lightblue',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'white',
        //     'hex_code' => '#FFFFFF',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'lightgreen',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'pink',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'darkgreen',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'lightgrey',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'kaki',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'lightrose',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'cream',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'rey',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'firered',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'militarygreen',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'blueish',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'navy',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'mauve',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'neonyellow',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'olive',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'eggplant',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'fadedblue',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'cyan',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'babyblue',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'stoneblue',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'rose',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'lightpurple',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'chestnut',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'grape',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'mocha',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'sky',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'turquoise',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'salmon',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'greenish',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'shiny',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'caramel',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'creamwhite',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'skyblue',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'colorful',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'golden',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'marron',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'mint',
        //     'hex_code' => '#FFFB00',
        // ]);
        // DB::connection('mysql')->table('colors')->insert([
        //     'name' => 'lavender',
        //     'hex_code' => '#FFFB00',
        // ]);
    }
}
