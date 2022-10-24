<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArticlePhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('article_photo')->truncate();

        // for ($i=1; $i <= 42; $i++) { 
        //     DB::connection('mysql')->table('article_photo')->insert([
        //         'article_id' => $i,
        //         'photo_id' => rand(1, 3),
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     ]);
        // }
        // for ($i=1; $i <= 42; $i++) { 
        //     DB::connection('mysql')->table('article_photo')->insert([
        //         'article_id' => $i,
        //         'photo_id' => rand(4, 5),
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     ]);
        // }

        // DB::connection('mysql')->table('article_photo')->insert([
        //     'article_id' => 43,
        //     'photo_id' => rand(1, 3),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_photo')->insert([
        //     'article_id' => 43,
        //     'photo_id' => rand(4, 5),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_photo')->insert([
        //     'article_id' => 44,
        //     'photo_id' => rand(1, 3),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_photo')->insert([
        //     'article_id' => 44,
        //     'photo_id' => rand(4, 5),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_photo')->insert([
        //     'article_id' => 45,
        //     'photo_id' => rand(1, 3),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // DB::connection('mysql')->table('article_photo')->insert([
        //     'article_id' => 45,
        //     'photo_id' => rand(4, 5),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);
    }
}
