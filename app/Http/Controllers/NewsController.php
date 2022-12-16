<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\NewsArticleCouture;
use App\Models\VillageInfo;

class NewsController extends Controller
{
    public function showAllNews()
    {
        if (auth()->check() && auth()->user()->role == 'admin') {
            $couture_news = NewsArticleCouture::orderBy('updated_at', 'desc')->get();
            $village_news = VillageInfo::orderBy('updated_at', 'desc')->get();
        } else {
            $couture_news = NewsArticleCouture::where('is_ready', '1')->orderBy('updated_at', 'desc')->get();
            $village_news = VillageInfo::where('is_ready', '1')->orderBy('updated_at', 'desc')->get();
        }
        return view('news', ['village_news' => $village_news, 'couture_news' => $couture_news]);
    }


    public function showNews(string $origin, string $slug)
    {
        if (auth()->check() && auth()->user()->canCheckNews()) {
            switch ($origin) {
                case 'couture':
                    if (NewsArticleCouture::where('slug_'.app()->getLocale(), $slug)->count() > 0) {
                        $news = NewsArticleCouture::where('slug_'.app()->getLocale(), $slug)->first();
                        $previous_news = NewsArticleCouture::where('created_at', '>', $news->created_at)
                                                      ->where('is_ready', '1')
                                                      ->orderBy('created_at', 'asc')
                                                      ->first();
                        $next_news = NewsArticleCouture::where('created_at', '<', $news->created_at)
                                                  ->where('is_ready', '1')
                                                  ->orderBy('created_at', 'desc')
                                                  ->first();
                        return view('news-single', ['news' => $news, 'previous_news' => $previous_news, 'next_news' => $next_news, 'origin' => $origin]);
                    }
                    break;

                case 'village':
                    if (VillageInfo::where('slug_'.app()->getLocale(), $slug)->count() > 0) {
                        $news = VillageInfo::where('slug_'.app()->getLocale(), $slug)->first();
                        $previous_news = VillageInfo::where('created_at', '>', $news->created_at)
                                                      ->where('is_ready', '1')
                                                      ->orderBy('created_at', 'asc')
                                                      ->first();
                        $next_news = VillageInfo::where('created_at', '<', $news->created_at)
                                                  ->where('is_ready', '1')
                                                  ->orderBy('created_at', 'desc')
                                                  ->first();
                        return view('news-single', ['news' => $news, 'previous_news' => $previous_news, 'next_news' => $next_news, 'origin' => $origin]);
                    }
                    break;

                case 'sloow':
                    // Update when SLOOW news are available
                    return redirect()->route('news-all-'.app()->getLocale());
                    break;
                
                default:
                    return redirect()->route('news-all-'.app()->getLocale());
                    break;
            }
        } else {
            switch ($origin) {
                case 'couture':
                    if (NewsArticleCouture::where('slug_'.app()->getLocale(), $slug)->where('is_ready', '1')->count() > 0) {
                        $news = NewsArticleCouture::where('slug_'.app()->getLocale(), $slug)->first();
                        $previous_news = NewsArticleCouture::where('created_at', '>', $news->created_at)
                                                      ->where('is_ready', '1')
                                                      ->orderBy('created_at', 'asc')
                                                      ->first();
                        $next_news = NewsArticleCouture::where('created_at', '<', $news->created_at)
                                                  ->where('is_ready', '1')
                                                  ->orderBy('created_at', 'desc')
                                                  ->first();
                        return view('news-single', ['news' => $news, 'previous_news' => $previous_news, 'next_news' => $next_news, 'origin' => $origin]);
                    }
                    break;

                case 'village':
                    if (VillageInfo::where('slug_'.app()->getLocale(), $slug)->where('is_ready', '1')->count() > 0) {
                        $news = VillageInfo::where('slug_'.app()->getLocale(), $slug)->first();
                        $previous_news = VillageInfo::where('created_at', '>', $news->created_at)
                                                      ->where('is_ready', '1')
                                                      ->orderBy('created_at', 'asc')
                                                      ->first();
                        $next_news = VillageInfo::where('created_at', '<', $news->created_at)
                                                  ->where('is_ready', '1')
                                                  ->orderBy('created_at', 'desc')
                                                  ->first();
                        return view('news-single', ['news' => $news, 'previous_news' => $previous_news, 'next_news' => $next_news, 'origin' => $origin]);
                    }
                    break;

                case 'sloow':
                    // Update when SLOOW news are available
                    return redirect()->route('news-all-'.app()->getLocale());
                    break;
                
                default:
                    return redirect()->route('news-all-'.app()->getLocale());
                    break;
            }
        }
    }
}
