<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // Required before importation, to clear updated tables and relationship tables
            // ArticlePhotoSeeder::class,
            // ArticleShopSeeder::class,
            // DeliveryCountrySeeder::class,
            // TranslationSeeder::class,
            // ArticleSeeder::class,
            // CreationCreationGroupSeeder::class,
            // BadgeSeeder::class,

            // Not required anymore
            // ArticleCareRecommendationSeeder::class,
            // ArticleCompositionSeeder::class,

            // Required before importation only in case of common DB update
            // UserSeeder::class,
            // PartnerSeeder::class,
            // ShopSeeder::class,

            // Imported - Use data importation route
            // ColorSeeder::class,
            // SizeSeeder::class,
            // CreationGroupSeeder::class,
            // CreationCategorySeeder::class,
            // KeywordSeeder::class,
            // CreationSeeder::class,
            // CreationAccessorySeeder::class,
            // CareRecommendationSeeder::class,
            // CompositionSeeder::class,
            // ArticleSeeder::class,
            // PhotoSeeder::class,
            // CreationKeywordSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
