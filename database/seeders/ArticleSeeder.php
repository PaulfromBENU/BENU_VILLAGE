<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('articles')->truncate();
        
        $name_options = ['article-01', 'model-02', 'declinaison-03', 'article-name'];
        $mask_options = ['mask-01', 'mask-02', 'mask-03', 'mask-04'];
        $type_options = ['article', 'mask', ''];
        $vouchertype_options = ['pdf', 'fabric'];

    //     for ($i=0; $i < 20; $i++) { 
    //         DB::connection('mysql')->table('articles')->insert([
    //             'name' => $name_options[array_rand($name_options)],
    //             'type' => 'article',
    //             'creation_id' => rand(1, 10),
    //             'size_id' => rand(1, 10),
    //             'color_id' => rand(1, 8),
    //             'mask_stripes' => '',
    //             'singularity_lu' => 'Une particularité de cet article, écrit en luxembourgeois',
    //             'singularity_de' => 'article.singularity-modelname-articlename',
    //             'singularity_en' => 'Une particularité de cet article, écrit en anglais',
    //             'singularity_fr' => 'Une particularité de cet article, écrit en français',
    //             'is_returned' => '0',
    //             'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //             'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //         ]);
    //     }

    //     for ($i=0; $i < 20; $i++) { 
    //         DB::connection('mysql')->table('articles')->insert([
    //             'name' => $mask_options[array_rand($mask_options)],
    //             'type' => 'mask',
    //             'mask_stripes' => 'elastic',
    //             'mask_filter' => '1',
    //             'singularity_lu' => 'Une particularité de cet article, écrit en luxembourgeois',
    //             'singularity_de' => 'article.singularity-modelname-articlename',
    //             'singularity_en' => 'Une particularité de cet article, écrit en anglais',
    //             'singularity_fr' => 'Une particularité de cet article, écrit en français',
    //             'is_returned' => '0',
    //             'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //             'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //         ]);
    //     }

        for ($i=0; $i < 2; $i++) { 
            DB::connection('mysql')->table('articles')->insert([
                'name' => "voucher",
                'is_extra_accessory' => '0',
                'checked' => '1',
                'voucher_type' => $vouchertype_options[$i],
                'singularity_lu' => '',
                'singularity_de' => '',
                'singularity_en' => '',
                'singularity_fr' => '',
                'is_returned' => '0',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

    //     DB::connection('mysql')->table('articles')->insert([
    //         'name' => 'malati-01',
    //         'type' => 'article',
    //         'creation_id' => 12,
    //         'size_id' => rand(1, 10),
    //         'color_id' => rand(1, 8),
    //         'mask_stripes' => '',
    //         'singularity_lu' => 'Une particularité de cet article, écrit en luxembourgeois',
    //         'singularity_de' => 'article.singularity-modelname-articlename',
    //         'singularity_en' => 'Une particularité de cet article, écrit en anglais',
    //         'singularity_fr' => 'Une particularité de cet article, écrit en français',
    //         'is_returned' => '0',
    //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //     ]);

    //     DB::connection('mysql')->table('articles')->insert([
    //         'name' => 'malati-02',
    //         'type' => 'article',
    //         'creation_id' => 12,
    //         'size_id' => rand(1, 10),
    //         'color_id' => rand(1, 8),
    //         'mask_stripes' => '',
    //         'singularity_lu' => 'Une particularité de cet article, écrit en luxembourgeois',
    //         'singularity_de' => 'article.singularity-modelname-articlename',
    //         'singularity_en' => 'Une particularité de cet article, écrit en anglais',
    //         'singularity_fr' => 'Une particularité de cet article, écrit en français',
    //         'is_returned' => '0',
    //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //     ]);

    //     DB::connection('mysql')->table('articles')->insert([
    //         'name' => 'malati-03',
    //         'type' => 'article',
    //         'creation_id' => 12,
    //         'size_id' => rand(1, 10),
    //         'color_id' => rand(1, 8),
    //         'mask_stripes' => '',
    //         'singularity_lu' => 'Une particularité de cet article, écrit en luxembourgeois',
    //         'singularity_de' => 'article.singularity-modelname-articlename',
    //         'singularity_en' => 'Une particularité de cet article, écrit en anglais',
    //         'singularity_fr' => 'Une particularité de cet article, écrit en français',
    //         'is_returned' => '0',
    //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //     ]);
    }
}
