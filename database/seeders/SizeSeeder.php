<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('sizes')->delete();
        
        $category_options = ['adult', 'kid', 'other'];
        $value_options = ['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL', '5XL', '38', '40', '42', '44', '47,5', '48,5', 'All', '62', '85', '74', '86', '68', '82', '60', '55', '50'];

        for ($i=0; $i < count($value_options); $i++) { 
            DB::connection('mysql')->table('sizes')->insert([
                'category' => $category_options[array_rand($category_options)],
                'value' => $value_options[$i],
            ]);
        }
    }
}
