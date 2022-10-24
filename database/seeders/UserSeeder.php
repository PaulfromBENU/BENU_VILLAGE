<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::connection('mysql_common')->table('users')->truncate();

        // DB::connection('mysql_common')->table('users')->insert([
        //     'email' => 'admin@benu.lu',
        //     'password' => Hash::make('temp@dmin'),
        //     'role' => 'admin',
        //     'first_name' => 'Administrator',
        //     'last_name' => 'BENU',
        //     'gender' => 'neutral',
        //     'company' => 'BENU',
        //     'phone' => '+352 27 91 19 49',
        //     'is_over_18' => '1',
        //     'legal_ok' => '1',
        //     'newsletter' => '0',
        //     'origin' => 'couture',
        //     'client_number' => 'C00000',
        //     'favorite_language' => 'en',
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'general_comment' => "No comment",
        // ]);

        // DB::connection('mysql_common')->table('users')->insert([
        //     'email' => 'paul.guillard@benu.lu',
        //     'password' => Hash::make('temp@Dev'),
        //     'role' => 'admin',
        //     'first_name' => 'Paul',
        //     'last_name' => 'Guillard',
        //     'gender' => 'male',
        //     'company' => 'BENU',
        //     'phone' => '+352 691 22 93 58',
        //     'is_over_18' => '1',
        //     'legal_ok' => '1',
        //     'newsletter' => '1',
        //     'origin' => 'couture',
        //     'client_number' => 'C00001',
        //     'favorite_language' => 'fr',
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'general_comment' => "No comment",
        // ]);

        // DB::connection('mysql_common')->table('users')->insert([
        //     'email' => 'shop@benu.lu',
        //     'password' => Hash::make('temp@Shop'),
        //     'role' => 'vendor',
        //     'first_name' => 'Shop',
        //     'last_name' => 'BENU',
        //     'gender' => 'neutral',
        //     'company' => 'BENU',
        //     'phone' => '+352 27 91 19 49',
        //     'is_over_18' => '1',
        //     'legal_ok' => '1',
        //     'newsletter' => '0',
        //     'origin' => 'couture',
        //     'client_number' => 'C00002',
        //     'favorite_language' => 'en',
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'general_comment' => "No comment",
        // ]);
    }
}
