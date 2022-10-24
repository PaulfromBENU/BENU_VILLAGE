<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArticleShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('article_shop')->truncate();

        // for ($i=1; $i <= 42; $i++) { 
        //     DB::connection('mysql')->table('article_shop')->insert([
        //         'article_id' => $i,
        //         'shop_id' => rand(1, 3),
        //         'stock' => rand(0, 10),
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     ]);
        // }

        // DB::connection('mysql')->table('article_shop')->insert([
        //     'article_id' => 43,
        //     'shop_id' => 1,
        //     'stock' => rand(1, 10),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_shop')->insert([
        //     'article_id' => 44,
        //     'shop_id' => 2,
        //     'stock' => rand(1, 10),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_shop')->insert([
        //     'article_id' => 44,
        //     'shop_id' => 3,
        //     'stock' => rand(1, 10),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_shop')->insert([
        //     'article_id' => 45,
        //     'shop_id' => 3,
        //     'stock' => 0,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_shop')->insert([
        //     'article_id' => 45,
        //     'shop_id' => 1,
        //     'stock' => 0,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);
    }
}
