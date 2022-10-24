<?php

namespace App\Traits;

use App\Models\Article;
use App\Models\Photo;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Intervention\Image\Facades\Image;

trait VariationPhotoHandler {
	public function savePhotoWithWatermark($picture, $creation_name, $article_name, $photo_counter, $random_id)
	{
		$file_name = 'processed/'.$creation_name.'/'.$article_name.'-'.$random_id.''.$photo_counter.'.png';
		// File name should have the following naming: 'processed/Creation_name/Article_name-'.rand(100, 999).'photo_counter'.png';

		$img = Image::make($picture);
        if ($img->width() > $img->height()) {
            $img->rotate(-90);
        }
        $img->resize(504, 672, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // create a new Image instance for inserting a watermark - !! WATERMARK REMOVED FOR THE MOMENT
        // $watermark = Image::make(public_path('images/pictures/logo_benu_couture_watermark.png'));
        // $watermark->resize(56, 75, function ($constraint) {
        //     $constraint->aspectRatio();
        //     $constraint->upsize();
        // });
        // $img->insert($watermark, 'bottom-right', 20, 20);

        $save_path = public_path('images/pictures/articles/processed/'.$creation_name);

        if(!File::isDirectory($save_path)){
            File::makeDirectory($save_path);//, 0755, true, true
        }

        return $img->save(public_path('images/pictures/articles/'.$file_name));
	}
}