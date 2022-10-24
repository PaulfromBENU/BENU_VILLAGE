<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Badge;
use App\Models\User;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql_common')->table('badges')->delete();

        DB::connection('mysql_common')->table('badges')->insert([
            'name' => 'Brain COUTURE 2022',
            'type' => 'brain',
            'origin' => 'couture',
            'year' => 2022,
            'svg_file' => 'icon_benu_couture_brain_2022_OK',
        ]);

        DB::connection('mysql_common')->table('badges')->insert([
            'name' => 'Top User COUTURE 2022',
            'type' => 'topuser',
            'origin' => 'couture',
            'year' => 2022,
            'svg_file' => 'icon_benu_couture_top_user_2022_OK',
        ]);

        // User::find(2)->badges()->attach(Badge::where('name', 'Brain COUTURE 2022')->first()->id);
        // User::find(2)->badges()->attach(Badge::where('name', 'Top User COUTURE 2022')->first()->id);
    }
}
