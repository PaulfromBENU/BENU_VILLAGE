<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Article;
use App\Models\Creation;
use App\Models\ModelFilter;

use App\Traits\ArticleAnalyzer;
use App\Traits\FiltersGenerator;

class ModelController extends Controller
{
    use ArticleAnalyzer;
    use FiltersGenerator;

    public function __construct()
    {
        session()->forget('payment-ongoing');
    }

    public function show(Request $request)
    {
        // Unslugify creation name
        $model_name = strtoupper(Str::of($request->name)->replace('-', ' '));

        // Case model name is not specified, all models are displayed ---------------------------------------
        if ($model_name == '' || $model_name == null) {
            // Ensure family is set and belongs to the possible options
            if (!isset($request->family)) {
                return redirect()->route('model-'.app()->getLocale(), ['family' => 'clothes']);
            } elseif (!in_array($request->family, ['clothes', 'accessories', 'home'])) {
                return redirect()->route('model-'.app()->getLocale(), ['family' => 'clothes']);
            }

            // Compute all filter options, names and status from FiltersGenerator Trait
            $filter_data = $this->getInitialFilters($request);
            $initial_filters = $filter_data[0];
            $filter_names = $filter_data[1];

            // Persists initial filters in the database to be reused on specific model pages
            if (session('secret_id') != null) {
                $stored_filters = ModelFilter::firstOrNew([
                    'session_id' => session('secret_id')
                ]);
            } else {
                $secret_session_id = Str::random(40);
                $stored_filters = new ModelFilter();
                $stored_filters->session_id = $secret_session_id;
                session(['secret_id' => $secret_session_id]);
            }
            
            $stored_filters->applied_filters = json_encode($initial_filters);
            $stored_filters->save();

            return view('models', ['filter_names' => $filter_names, 'initial_filters' => $initial_filters, 'family' => $request->family]);
        }


        // Case model name is specified, specific model is displayed ---------------------------------------
        // Case incorrect creation name has been written in URL
        if (Creation::where('name', $model_name)->count() == 0) {
            return redirect()->route('model-'.app()->getLocale());
        }

        // Case model name is specified, dedicated page with articles is displayed
        $creation = Creation::where('name', $model_name)->first();
        $localized_desc_query = 'description_'.app()->getLocale();
        $localized_desc = $creation->$localized_desc_query;

        $creation_articles = $this->getAvailableArticles($creation);

        // Extra accessories
        $extra_accessories = $this->getAvailableExtraAccessories($creation);

        // Sold articles
        $all_sold_articles = $this->getSoldArticles($creation);
        $sold_articles = $all_sold_articles->slice(0, 4);
        $sold_articles_total = $all_sold_articles->count();

        //Select pictures to display next to the creation description
        $model_pictures = collect([]);
        foreach ($creation_articles as $article) {
            if ($article->photos()->where('is_front', '1')->count() > 0) {
                $model_pictures->push($article->photos()->where('is_front', '1')->first()->file_name);
            } else {
                $model_pictures->push($article->photos()->first()->file_name);
            }
        }

        // If no article available, display sold article pictures
        if ($model_pictures->count() == 0) {
            foreach ($sold_articles as $sold_article) {
                $model_pictures->push($sold_article->photos()->first()->file_name);
            }
        }
        
        // Keywords selection with localized description for current model
        $localized_keyword_query = 'keyword_'.app()->getLocale();
        // Provide creation keywords in an array
        $keywords = [];
        foreach ($creation->keywords as $keyword) {
            array_push($keywords, $keyword->$localized_keyword_query);
        }

        // Compute all filter options, names and status from FiltersGenerator Trait
        $filter_names = $this->getArticlesFilterOptions($creation)[1];
        $initial_filters = $this->getArticlesInitialFilters($request, $creation);

        // Handle persisted filters to keep consistency from one page to another
        if (session('secret_id') != null && ModelFilter::where('session_id', session('secret_id'))->count() > 0) {
            $applied_filters = json_decode(ModelFilter::where('session_id', session('secret_id'))->first()->applied_filters, true);
            // Take only filter values that are avaiolable for this specific creation
            foreach ($initial_filters['colors'] as $color => $filter_value) {
                $initial_filters['colors'][$color] = $applied_filters['colors'][$color];
            }
            foreach ($initial_filters['shops'] as $shop => $filter_value) {
                $initial_filters['shops'][$shop] = $applied_filters['shops'][$shop];
            }

            // Destroy secret_id and DB temporary data after it has been applied
            ModelFilter::where('session_id', session('secret_id'))->delete();
            $request->session()->forget('secret_id');
        }

        $article_id = 0;
        if (isset($request->article) && Article::where('name', ucfirst($request->article))->count() > 0) {
            $article_id = Article::where('name', ucfirst($request->article))->first()->id;
        }
        
        return view('model', [
            'model' => $creation, 
            'localized_description' => $localized_desc, 
            'articles' => $creation_articles, 
            'extra_accessories' => $extra_accessories,
            'sold_articles' => $sold_articles, 
            'sold_articles_total' => $sold_articles_total,
            'keywords' => $keywords,
            'model_pictures' => $model_pictures,
            'filter_names' => $filter_names,
            'initial_filters' => $initial_filters,
            'article_id' => $article_id,
            'slug' => $request->name,
        ]);
    }

    public function soldItems(Request $request, string $name) 
    {
        if ($name == '' || $name == null) {
            return redirect()->route('model-'.app()->getLocale());
        }

        $creation = Creation::where('name', $name)->first();
        $sold_articles = $this->getSoldArticles($creation);

        // Compute all filter options, names and status from FiltersGenerator Trait
        $filter_names = $this->getSoldFilterOptions($creation)[1];
        $initial_filters = $this->getSoldInitialFilters($request, $creation);

        return view('sold-items', ['model_name' => $name, 'model' => $creation, 'sold_articles' => $sold_articles, 'initial_filters' => $initial_filters, 'filter_names' => $filter_names]);
    }
}
