<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CareRecommendation;
use App\Models\Shop;
use App\Models\Translation;

class ContactController extends Controller
{
    public function __construct()
    {
        session()->forget('payment-ongoing');
    }

    //Request mandatory in all functions to allow for parameters conservation in locale selector
    public function show()
    {
        return view('contact');
    }

    public function showAll($page = '')
    {
        // When changing locale while in a sub-section of the page, redirect to the page without parameter. Also handles random URI parameters.
        if (!in_array($page, [
            __('slugs.services-faq'),
            __('slugs.services-delivery'),
            __('slugs.services-sizes'),
            __('slugs.services-return'),
            __('slugs.services-payment'),
            __('slugs.services-care'),
            __('slugs.services-shops'),
            __('slugs.services-contact'),
            ''
        ])) {
            return redirect()->route('client-service-'.app()->getLocale());
        }

        $shops_benu = collect([]);
        $shops_other = collect([]);
        if ($page == __('slugs.services-shops')) {
            $shops_benu = Shop::where('type', 'BENU owned')->orderBy('created_at', 'desc')->get();
            $shops_other = Shop::where('type', '<>', 'BENU owned')->orderBy('created_at', 'desc')->get();
        }

        $wash_recommendations = collect([]);
        $dry_recommendations = collect([]);
        $iron_recommendations = collect([]);
        if ($page == __('slugs.services-care')) {
            $wash_recommendations = CareRecommendation::where('family', 'wash')->get();
            $dry_recommendations = CareRecommendation::where('family', 'dry')->get();
            $iron_recommendations = CareRecommendation::where('family', 'iron')->get();
        }

        $faq_titles_count = 0;
        $faq_subtitles_count = [];
        if ($page == __('slugs.services-faq') || $page == '') {
            $faq_titles_count = Translation::where('page', 'services')->where('key', 'LIKE', 'faq-group-title-'.'%')->count();
            for ($i=1; $i <= $faq_titles_count; $i++) { 
                $faq_subtitles_count[$i] = Translation::where('page', 'services')->where('key', 'LIKE', 'faq-group-'.$i.'-question-title-%')->count();
            }
        }

        $localized_desc_query = "description_".app()->getLocale();

        return view('client-service', ['page' => $page, 'shops_benu' => $shops_benu, 'shops_other' => $shops_other, 'desc_query' => $localized_desc_query, 'faq_titles_count' => $faq_titles_count, 'faq_subtitles_count' => $faq_subtitles_count, 'wash_recommendations' => $wash_recommendations, 'dry_recommendations' => $dry_recommendations, 'iron_recommendations' => $iron_recommendations]);
    }
}
