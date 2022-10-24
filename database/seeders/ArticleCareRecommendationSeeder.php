<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArticleCareRecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('article_care_recommendation')->truncate();

        // for ($i=1; $i <= 42; $i++) { 
        //     DB::connection('mysql')->table('article_care_recommendation')->insert([
        //         'article_id' => $i,
        //         'care_recommendation_id' => rand(1, 2),
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     ]);
        // }
        // for ($i=1; $i <= 42; $i++) { 
        //     DB::connection('mysql')->table('article_care_recommendation')->insert([
        //         'article_id' => $i,
        //         'care_recommendation_id' => 3,
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     ]);
        // }

        // DB::connection('mysql')->table('article_care_recommendation')->insert([
        //     'article_id' => 43,
        //     'care_recommendation_id' => rand(1, 2),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_care_recommendation')->insert([
        //     'article_id' => 43,
        //     'care_recommendation_id' => 3,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_care_recommendation')->insert([
        //     'article_id' => 44,
        //     'care_recommendation_id' => rand(1, 2),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_care_recommendation')->insert([
        //     'article_id' => 44,
        //     'care_recommendation_id' => 3,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_care_recommendation')->insert([
        //     'article_id' => 45,
        //     'care_recommendation_id' => rand(1, 2),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_care_recommendation')->insert([
        //     'article_id' => 45,
        //     'care_recommendation_id' => 3,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);
    }
}
