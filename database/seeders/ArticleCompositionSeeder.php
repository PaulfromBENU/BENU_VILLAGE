<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArticleCompositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('article_composition')->truncate();

        // for ($i=1; $i <= 42; $i++) { 
        //     DB::connection('mysql')->table('article_composition')->insert([
        //         'article_id' => $i,
        //         'composition_id' => rand(1, 3),
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     ]);
        // }
        // for ($i=1; $i <= 42; $i++) { 
        //     DB::connection('mysql')->table('article_composition')->insert([
        //         'article_id' => $i,
        //         'composition_id' => rand(4, 5),
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     ]);
        // }

        // DB::connection('mysql')->table('article_composition')->insert([
        //     'article_id' => 43,
        //     'composition_id' => rand(1, 3),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_composition')->insert([
        //     'article_id' => 43,
        //     'composition_id' => rand(4, 5),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_composition')->insert([
        //     'article_id' => 44,
        //     'composition_id' => rand(1, 3),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_composition')->insert([
        //     'article_id' => 44,
        //     'composition_id' => rand(4, 5),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_composition')->insert([
        //     'article_id' => 45,
        //     'composition_id' => rand(1, 3),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_composition')->insert([
        //     'article_id' => 45,
        //     'composition_id' => rand(4, 5),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);
    }
}
