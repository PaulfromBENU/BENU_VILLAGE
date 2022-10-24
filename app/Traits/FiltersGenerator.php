<?php

namespace App\Traits;

use Illuminate\Support\Collection;

use App\Models\Color;
use App\Models\Creation;
use App\Models\CreationCategory;
use App\Models\CreationGroup;
use App\Models\Partner;
use App\Models\Shop;
use App\Models\Size;

use App\Traits\ArticleAnalyzer;

trait FiltersGenerator {

    use ArticleAnalyzer;

    public function getFilterOptions($family = '')
    {
        $filter_options = [
            'families' => ['clothes', 'accessories', 'home'],
            'categories' => [],
            'colors' => [],
            'types' => [],
            'prices' => [],
            'partners' => [],
            'shops' => [],
        ];

        $filter_names = [
            'families' => [
                'clothes' => __('models.filter-clothes'),
                'accessories' => __('models.filter-accessories'),
                'home' => __('models.filter-home'),
            ],
            'categories' => [],
            'colors' => [],
            'types' => [],
            'prices' => [],
            'partners' => [],
            'shops' => [],
        ];

        $name_query = "name_".app()->getLocale();

        $unsorted_prices = [];
        $unsorted_types = [];
        $unsorted_categories = [];
        $unsorted_colors = [];

        foreach ($this->getAvailableCreations($family) as $creation) {
            //Creation categories
            $creation_category_key = $creation->creation_category->filter_key;
            $creation_category_name = $creation->creation_category->$name_query;
            if (!in_array($creation_category_key, $unsorted_categories)) {
                array_push($unsorted_categories, $creation_category_key);
                $filter_names['categories'][$creation_category_key] = $creation_category_name;
            }

            //Types
            $type_options = $creation->creation_groups;
            foreach ($type_options as $type) {
                $type_key = $type->filter_key;
                $type_name = $type->$name_query;
                if (!in_array($type_key, $unsorted_types)) {
                    array_push($unsorted_types, $type_key);
                    $filter_names['types'][$type_key] = $type_name;
                }
            }

            //Prices
            $article_price = $creation->price;
            if ($article_price >= 180) {
                $price_key = 'more';
                $price_name = "+180&euro;";
            } elseif ($article_price >= 121) {
                $price_key = '121-180';
                $price_name = "121-180&euro;";
            } elseif ($article_price >= 61) {
                $price_key = '61-120';
                $price_name = "61-120&euro;";
            } elseif ($article_price >= 31) {
                $price_key = '31-60';
                $price_name = "31-60&euro;";
            } else {
                $price_key = '0-30';
                $price_name = "0-30&euro;";
            }
            if (!in_array($price_key, $filter_options['prices'])) {
                array_push($unsorted_prices, $price_key);
                $filter_names['prices'][$price_key] = $price_name;
            }

            //Partners
            if ($creation->partner_id != null) {
                $partner_key = $creation->partner->filter_key;
                $partner_name = $creation->partner->name;
                if (!in_array($partner_key, $filter_options['partners'])) {
                    array_push($filter_options['partners'], $partner_key);
                    $filter_names['partners'][$partner_key] = $partner_name;
                }
            }

            // $creation_id = $creation->id;
            //Colors
            // $creation_colors = Color::whereHas('articles', function($query) use ($creation_id) {
            //     $query->where('creation_id', $creation_id)->has('available_shops');
            // })->get();

            // if ($creation_colors->count() > 0) {
            //     foreach ($creation_colors as $color) {
            //         $color_key = $color->name;
            //         if (!in_array($color_key, $filter_options['colors'])) {
            //             $color_name = __("colors.".$color_key);
            //             array_push($filter_options['colors'], $color_key);
            //             $filter_names['colors'][$color_key] = $color_name;
            //         }
            //     }
            // }
        }


        // Sorting the categories by alphabetical order
        $localized_category_query = 'name_'.session('locale');
        $sorted_categories = [];
        foreach (CreationCategory::all() as $category) {
            $sorted_categories[$category->filter_key] = $category->$localized_category_query;
        }

        asort($sorted_categories);
        // dd($unsorted_categories, $sorted_categories);

        foreach ($sorted_categories as $key => $sorted_category) {
            if (($index = array_search($key, $unsorted_categories)) !== false) {
                array_push($filter_options['categories'], $unsorted_categories[$index]);
            }
        }


        // Sorting the types by header order
        $sorted_types = [
            'unisex' => __('header.unisex'), 
            'ladies' => __('header.women'), 
            'gentlemen' => __('header.men'), 
            'adults' => __('header.adults'), 
            'kids' => __('header.children'), 
            'accessories' => __('header.accessories'), 
            'home' => __('header.house')
        ];

        foreach ($sorted_types as $key => $sorted_type) {
            if (($index = array_search($key, $unsorted_types)) !== false) {
                array_push($filter_options['types'], $unsorted_types[$index]);
            }
        }


        // Sorting the prices
        $sorted_prices = [
            '0-30', '31-60', '61-120', '121-180', 'more'
        ];

        for ($i=0; $i < count($sorted_prices); $i++) { 
            if (($key = array_search($sorted_prices[$i], $unsorted_prices)) !== false) {
                array_push($filter_options['prices'], $unsorted_prices[$key]);
            }
        }

        // Colors
        switch ($family) {
            case 'clothes':
                $available_colors = Color::has('clothes')->get();
                break;

            case 'accessories':
                $available_colors = Color::has('accessories')->get();
                break;
            
            case 'home':
                $available_colors = Color::has('home')->get();
                break;

            default:
                $available_colors = Color::whereHas('articles', function($query) {
                    $query->has('available_shops');
                })->get();
                break;
        }

        foreach ($available_colors as $color) {
            $color_key = $color->name;
            if (!in_array($color_key, $unsorted_colors)) {
                $color_name = __("colors.".$color_key);
                array_push($unsorted_colors, $color_key);
                $filter_names['colors'][$color_key] = $color_name;
            }
        }

        // Sorting the colors by chromatic order
        $sorted_colors = [
            'white', 'beige', 'yellow', 'orange', 'red', 'pink', 'purple', 'blue', 'green', 'brown', 'grey', 'black', 'multicolored'
        ];

        foreach ($sorted_colors as $sorted_color) {
            if (($index = array_search($sorted_color, $unsorted_colors)) !== false) {
                array_push($filter_options['colors'], $unsorted_colors[$index]);
            }
        }

        // Shops
        $available_shops = Shop::has('articles_in_stock')->get();

        foreach ($available_shops as $shop) {
            $shop_key = $shop->filter_key;
            $shop_name = $shop->name;
            if (!in_array($shop_key, $filter_options['shops'])) {
                array_push($filter_options['shops'], $shop_key);
                $filter_names['shops'][$shop_key] = $shop_name;
            }
        }

        return [$filter_options, $filter_names];
    }

	public function getFilterOptionsOld()//Not used anymore, replaced by function above which is much more efficient
	{
		$filter_options = [
			'categories' => [],
			'colors' => [],
			'types' => [],
			'prices' => [],
			'partners' => [],
			'shops' => [],
		];

        $filter_names = [
            'categories' => [],
            'colors' => [],
            'types' => [],
            'prices' => [],
            'partners' => [],
            'shops' => [],
        ];

        $name_query = "name_".app()->getLocale();

		$category_filter_options = CreationCategory::all();
		foreach ($category_filter_options as $filter_option) {
            // Include in filter options only if options are available
            if ($this->checkIfFilterHasArticles('creation_category', $filter_option)) {
                array_push($filter_options['categories'], $filter_option->filter_key);
                $filter_names['categories'][$filter_option->filter_key] = $filter_option->$name_query;
            }
        }

        $color_filter_options = Color::all();
        foreach ($color_filter_options as $filter_option) {
            if($this->checkIfFilterHasArticles('colors', $filter_option)) {
                array_push($filter_options['colors'], $filter_option->name);
                $filter_names['colors'][$filter_option->name] = __("colors.".$filter_option->name);
            }
        }

        $type_filter_options = CreationGroup::all();
        foreach ($type_filter_options as $filter_option) {
            if($this->checkIfFilterHasArticles('creation_group', $filter_option)) {
                array_push($filter_options['types'], $filter_option->filter_key);
                $filter_names['types'][$filter_option->filter_key] = $filter_option->$name_query;
            }
        }

        $price_options = ['0-30', '31-60', '61-120', '121-180', 'more'];
        foreach ($price_options as $price) {
            if($this->checkIfFilterHasArticles('prices', $price)) {
                if($price == 'more') {
                    array_push($filter_options['prices'], 'more');
                    $filter_names['prices']['more'] = "+180&euro;";
                }
                else {
                    array_push($filter_options['prices'], $price);
                    $filter_names['prices'][$price] = $price."&euro;";
                }
            }
        }

        $partners_filter_options = Partner::all();
        foreach ($partners_filter_options as $filter_option) {
            // Include in filter options only if options are available
            if($this->checkIfFilterHasArticles('partners', $filter_option)) {
                array_push($filter_options['partners'], $filter_option->filter_key);
                $filter_names['partners'][$filter_option->filter_key] = $filter_option->name;
            }
        }

        $shops_filter_options = Shop::all();
        foreach ($shops_filter_options as $filter_option) {
            if($this->checkIfFilterHasArticles('shops', $filter_option)) {
                array_push($filter_options['shops'], $filter_option->filter_key);
                $filter_names['shops'][$filter_option->filter_key] = $filter_option->name;
            }
        }

        return [$filter_options, $filter_names];
	}

    public function getArticlesFilterOptions($creation)
    {
        $filter_options = [
            'sizes' => [],
            'colors' => [],
            'shops' => [],
        ];

        $filter_names = [
            'sizes' => [],
            'colors' => [],
            'shops' => [],
        ];

        $name_query = "name_".app()->getLocale();

        foreach ($this->getAvailableArticles($creation) as $article) {
            //Sizes
            $size_key = $article->size->value;
            $size_name = $size_key;
            if (!in_array($size_key, $filter_options['sizes'])) {
                array_push($filter_options['sizes'], $size_key);
                $filter_names['sizes'][$size_key] = $size_name;
            }

            //Colors
            $color_key = $article->color->name;
            $color_name = __("colors.".$color_key);
            if (!in_array($color_key, $filter_options['colors'])) {
                array_push($filter_options['colors'], $color_key);
                $filter_names['colors'][$color_key] = $color_name;
            }

            //Shops
            $shop_options = $article->shops()->wherePivot('stock', '>', '0')->get();
            foreach ($shop_options as $shop) {
                $shop_key = $shop->filter_key;
                $shop_name = $shop->name;
                if (!in_array($shop_key, $filter_options['shops'])) {
                    array_push($filter_options['shops'], $shop_key);
                    $filter_names['shops'][$shop_key] = $shop_name;
                }
            }
        }

        return [$filter_options, $filter_names];
    }

    public function getArticlesFilterOptionsOld($creation)
    {
        $filter_options = [
            'sizes' => [],
            'colors' => [],
            'shops' => [],
        ];

        $filter_names = [
            'sizes' => [],
            'colors' => [],
            'shops' => [],
        ];

        $name_query = "name_".app()->getLocale();

        $size_filter_options = Size::all();
        foreach ($size_filter_options as $filter_option) {
            if($this->checkIfArticleFilterHasArticles($creation, 'sizes', $filter_option)) {
                array_push($filter_options['sizes'], $filter_option->value);
                $filter_names['sizes'][$filter_option->value] = $filter_option->value;
            }
        }

        $color_filter_options = Color::all();
        foreach ($color_filter_options as $filter_option) {
            if($this->checkIfArticleFilterHasArticles($creation, 'colors', $filter_option)) {
                array_push($filter_options['colors'], $filter_option->name);
                $filter_names['colors'][$filter_option->name] = __("colors.".$filter_option->name);
            }
        }

        $shops_filter_options = Shop::all();
        foreach ($shops_filter_options as $filter_option) {
            if($this->checkIfArticleFilterHasArticles($creation, 'shops', $filter_option)) {
                array_push($filter_options['shops'], $filter_option->filter_key);
                $filter_names['shops'][$filter_option->filter_key] = $filter_option->name;
            }
        }

        return [$filter_options, $filter_names];
    }

    public function getSoldFilterOptions($creation)
    {
        $filter_options = [
            'sizes' => [],
            'colors' => [],
            'shops' => [],
        ];

        $filter_names = [
            'sizes' => [],
            'colors' => [],
            'shops' => [],
        ];

        $name_query = "name_".app()->getLocale();

        foreach ($this->getSoldArticles($creation) as $article) {
            //Sizes
            $size_key = $article->size->value;
            $size_name = $size_key;
            if (!in_array($size_key, $filter_options['sizes'])) {
                array_push($filter_options['sizes'], $size_key);
                $filter_names['sizes'][$size_key] = $size_name;
            }

            //Colors
            $color_key = $article->color->name;
            $color_name = __("colors.".$color_key);
            if (!in_array($color_key, $filter_options['colors'])) {
                array_push($filter_options['colors'], $color_key);
                $filter_names['colors'][$color_key] = $color_name;
            }

            //Shops
            $shop_options = $article->shops()->wherePivot('stock', '>', '0')->get();
            foreach ($shop_options as $shop) {
                $shop_key = $shop->filter_key;
                $shop_name = $shop->name;
                if (!in_array($shop_key, $filter_options['shops'])) {
                    array_push($filter_options['shops'], $shop_key);
                    $filter_names['shops'][$shop_key] = $shop_name;
                }
            }
        }

        return [$filter_options, $filter_names];
    }

    public function getSoldFilterOptionsOld($creation)
    {
        $filter_options = [
            'sizes' => [],
            'colors' => [],
            'shops' => [],
        ];

        $filter_names = [
            'sizes' => [],
            'colors' => [],
            'shops' => [],
        ];

        $name_query = "name_".app()->getLocale();

        $size_filter_options = Size::all();
        foreach ($size_filter_options as $filter_option) {
            if($this->checkIfSoldFilterHasArticles($creation, 'sizes', $filter_option)) {
                array_push($filter_options['sizes'], $filter_option->value);
                $filter_names['sizes'][$filter_option->value] = $filter_option->value;
            }
        }

        $color_filter_options = Color::all();
        foreach ($color_filter_options as $filter_option) {
            if($this->checkIfSoldFilterHasArticles($creation, 'colors', $filter_option)) {
                array_push($filter_options['colors'], $filter_option->name);
                $filter_names['colors'][$filter_option->name] = __("colors.".$filter_option->name);
            }
        }

        $shops_filter_options = Shop::all();
        foreach ($shops_filter_options as $filter_option) {
            if($this->checkIfSoldFilterHasArticles($creation, 'shops', $filter_option)) {
                array_push($filter_options['shops'], $filter_option->filter_key);
                $filter_names['shops'][$filter_option->filter_key] = $filter_option->name;
            }
        }
        
        return [$filter_options, $filter_names];
    }



	public function getInitialFilters($request)
	{
        $all_options = $this->getFilterOptions($request->family);
		$filter_options = $all_options[0]; // Get only filter keys

		$initial_filters = [
			'categories' => [],
			'colors' => [],
			'types' => [],
			'prices' => [],
			'partners' => [],
			'shops' => [],
		];

		// Initialize all filters to 0 by default, and to 1 if present in request
		foreach ($filter_options as $filter => $options) {
			foreach ($options as $option) {
				$initial_filters[$filter][$option] = 0;
                if (isset($request->$filter)) {
                    $requested_filters = explode("*", $request->$filter);
                    foreach ($requested_filters as $requested_filter) {
                        if (isset($initial_filters[$filter][$requested_filter])) {
                            $initial_filters[$filter][$requested_filter] = 1;
                        }
                    }
                }
			}
		}

        return [$initial_filters, $all_options[1]];
	}

    public function getArticlesInitialFilters($request, $creation)
    {
        $filter_options = $this->getArticlesFilterOptions($creation)[0]; // Get only filter keys

        $initial_filters = [
            'sizes' => [],
            'colors' => [],
            'shops' => [],
        ];

        // Initialize all filters to 0 by default, and to 1 if present in request
        foreach ($filter_options as $filter => $options) {
            foreach ($options as $option) {
                $initial_filters[$filter][$option] = 0;
                if (isset($request->$filter)) {
                    $requested_filters = explode("*", $request->$filter);
                    foreach ($requested_filters as $requested_filter) {
                        if (isset($initial_filters[$filter][$requested_filter])) {
                            $initial_filters[$filter][$requested_filter] = 1;
                        }
                    }
                }
            }
        }

        return $initial_filters;
    }

    public function getSoldInitialFilters($request, $creation)
    {
        $filter_options = $this->getSoldFilterOptions($creation)[0]; // Get only filter keys

        $initial_filters = [
            'sizes' => [],
            'colors' => [],
            'shops' => [],
        ];

        // Initialize all filters to 0 by default, and to 1 if present in request
        foreach ($filter_options as $filter => $options) {
            foreach ($options as $option) {
                $initial_filters[$filter][$option] = 0;
                if (isset($request->$filter)) {
                    $requested_filters = explode("*", $request->$filter);
                    foreach ($requested_filters as $requested_filter) {
                        if (isset($initial_filters[$filter][$requested_filter])) {
                            $initial_filters[$filter][$requested_filter] = 1;
                        }
                    }
                }
            }
        }

        return $initial_filters;
    }



    public function getFilteredCreations($applied_filters, $family = '')
    {
        $available_creations = $this->getAvailableCreations($family);
        
        // Apply filters on all creations available
        // Get filtered category creations. If no filter selected, keep all creations
        $models_filtered_by_category = collect([]);
        $category_filters_applied = 0;
        $category_models_count = 0;
        foreach ($applied_filters['categories'] as $category => $filter_value) {
            if ($filter_value == '1') {
                $category_filters_applied ++;
                if($available_creations->where('creation_category.filter_key', $category)->count() > 0) {
                    $models_filtered_by_category = $models_filtered_by_category->merge($available_creations->where('creation_category.filter_key', $category));
                    $category_models_count ++;
                }
            }
        } 
        if ($category_filters_applied == 0) {
            $category_models_count ++;
            $models_filtered_by_category = $available_creations;
        }
        if ($category_models_count == 0) {
            return collect([]);
        }

        // Filter remaining creations by type/group. If no filter selected, keep all previous creations
        $models_filtered_by_type = collect([]);
        $type_filters_applied = 0;
        $type_models_count = 0;
        foreach ($applied_filters['types'] as $type => $filter_value) {
            if ($filter_value == '1') {
                $type_filters_applied ++;
                //
                foreach ($models_filtered_by_category as $creation_checked_for_type) {
                    if ($creation_checked_for_type->creation_groups->contains(CreationGroup::where('filter_key', $type)->first()->id)) {
                        // Many to many relationship with type => need to check if creation not already present
                        if (!$models_filtered_by_type->contains('id', $creation_checked_for_type->id)) {
                            $models_filtered_by_type = $models_filtered_by_type->push($creation_checked_for_type);
                            $type_models_count ++;
                        }
                    }
                }
                //
                // if ($models_filtered_by_category->where('creation_group.filter_key', $type)->count() > 0) {
                //     $models_filtered_by_type = $models_filtered_by_type->merge($models_filtered_by_category->where('creation_group.filter_key', $type));
                //     $type_models_count ++;
                // }
            }
         } 
        if ($type_filters_applied == 0) {
            $type_models_count ++;
            $models_filtered_by_type = $models_filtered_by_category;
        }
        if ($type_models_count == 0) {
            return collect([]);
        }

        // Filter remaining creations by color. If no filter selected, keep all previous creations
        $models_filtered_by_color = collect([]);
        $color_filters_applied = 0;
        $color_models_count = 0;
        foreach ($applied_filters['colors'] as $color => $filter_value) {
            if ($filter_value == '1') {
                $color_filters_applied ++;
                // Loop through each article of each filtered model to determine if color is available, and add it to filtered results if yes
                foreach ($models_filtered_by_type as $model_checked_for_color) {
                    $model_ok = 0;
                    // If model has at least one article with the requested color, consider it OK for filtering
                    // Issues on object type. Reset to Creation instance if not set as so.
                    // if (!($model_checked_for_color instanceof Creation)) {
                    //     $model_checked_for_color = $model_checked_for_color->first();
                    // }
                    foreach ($this->getAvailableArticles($model_checked_for_color) as $article) {
                        if ($article->color->name == $color) {
                            $model_ok = 1;
                        }
                    }
                    if ($model_ok == 1) {
                        $color_models_count ++;
                        $models_filtered_by_color->push($model_checked_for_color);
                    }
                }
            }
        }
        if ($color_filters_applied == 0) {
            $color_models_count ++;
            $models_filtered_by_color = $models_filtered_by_type;
        }
        if ($color_models_count == 0) {
            return collect([]);
        }

        // Filter remaining creations by price. If no price filter selected, keep all previous creations
        $models_filtered_by_price = collect([]);
        $price_filters_applied = 0;
        $price_models_count = 0;
        foreach ($applied_filters['prices'] as $price => $filter_value) {
            if ($filter_value == '1') {
                $price_filters_applied ++;
                if ($price == 'more') {
                    if($models_filtered_by_color->where('price', '>', '180')->count() > 0) {
                        $models_filtered_by_price = $models_filtered_by_price->merge($models_filtered_by_color->where('price', '>', '180'));
                        $price_models_count ++;
                    }
                } else {
                    $min_price = intval(explode("-", $price)[0]);
                    $max_price = intval(explode("-", $price)[1]) + 1;
                    if ($models_filtered_by_color->where('price', '>=', $min_price)->where('price', '<', $max_price)->count() > 0) {
                        $models_filtered_by_price = $models_filtered_by_price->merge($models_filtered_by_color->where('price', '>=', $min_price)->where('price', '<', $max_price));
                        $price_models_count ++;
                    }
                }
            }
         } 
        if ($price_filters_applied == 0) {
            $price_models_count ++;
            $models_filtered_by_price = $models_filtered_by_color;
        }
        if ($price_models_count == 0) {
            return collect([]);
        }

        // Filter remaining creations by partner. If no partner selected, keep all previous creations
        $models_filtered_by_partner = collect([]);
        $partner_filters_applied = 0;
        $partner_models_count = 0;
        foreach ($applied_filters['partners'] as $partner => $filter_value) {
            if ($filter_value == '1') {
                $partner_filters_applied ++;
                if ($models_filtered_by_price->where('partner.filter_key', $partner)->count() > 0) {
                    $models_filtered_by_partner = $models_filtered_by_partner->merge($models_filtered_by_price->where('partner.filter_key', $partner));
                    $partner_models_count ++;
                }
            }
         } 
        if ($partner_filters_applied == 0) {
            $partner_models_count ++;
            $models_filtered_by_partner = $models_filtered_by_price;
        }
        if ($partner_models_count == 0) {
            return collect([]);
        }

        // Filter remaining creations by shop. If no shop selected, keep all previous creations
        $models_filtered_by_shop = collect([]);
        $shop_filters_applied = 0;
        $shop_models_count = 0;
        foreach ($applied_filters['shops'] as $shop => $filter_value) {
            if ($filter_value == '1') {
                $shop_filters_applied ++;
                foreach ($models_filtered_by_partner as $model_checked_for_shop) {
                    $model_ok = 0;
                    // If model has at least one article with the requested color, consider it OK for filtering
                    // if (!($model_checked_for_shop instanceof Creation)) {
                    //     $model_checked_for_shop = $model_checked_for_shop->first();
                    // }
                    foreach ($this->getAvailableArticles($model_checked_for_shop) as $article) {
                        foreach ($article->shops as $article_shop) {
                            if ($article_shop->filter_key == $shop) {
                                $model_ok = 1;
                            }
                        }
                    }
                    if ($model_ok == 1) {
                        $shop_models_count ++;
                        $models_filtered_by_shop->push($model_checked_for_shop);
                    }
                }
            }
        } 
        if ($shop_filters_applied == 0) {
            $shop_models_count ++;
            $models_filtered_by_shop = $models_filtered_by_partner;
        }
        if ($shop_models_count == 0) {
            return collect([]);
        }
        
        $filtered_models = $models_filtered_by_shop;
        
        return $filtered_models;
    }

    public function getFilteredArticles(Creation $creation, $applied_filters, string $article_type)
    {
        if ($article_type == 'available') {
            $available_articles = $this->getAvailableArticles($creation);
        } else if ($article_type == 'sold') {
            $available_articles = $this->getSoldArticles($creation);
        }

        // Apply filters on all creations available
        // Get filtered category creations. If no filter selected, keep all creations
        $articles_filtered_by_size = collect([]);
        $size_filters_applied = 0;
        $size_articles_count = 0;
        foreach ($applied_filters['sizes'] as $size => $filter_value) {
            if ($filter_value == '1') {
                $size_filters_applied ++;
                if($available_articles->where('size.value', $size)->count() > 0) {
                    $articles_filtered_by_size = $articles_filtered_by_size->merge($available_articles->where('size.value', $size));
                    $size_articles_count ++;
                }
            }
         } 
        if ($size_filters_applied == 0) {
            $size_articles_count ++;
            $articles_filtered_by_size = $available_articles;
        }
        if ($size_articles_count == 0) {
            return collect([]);
        }

        // Filter remaining creations by color. If no filter selected, keep all previous creations
        $articles_filtered_by_color = collect([]);
        $color_filters_applied = 0;
        $color_articles_count = 0;
        foreach ($applied_filters['colors'] as $color => $filter_value) {
            if ($filter_value == '1') {
                $color_filters_applied ++;
                if($articles_filtered_by_size->where('color.name', $color)->count() > 0) {
                    $articles_filtered_by_color = $articles_filtered_by_color->merge($articles_filtered_by_size->where('color.name', $color));
                    $color_articles_count ++;
                }
            }
        }
        if ($color_filters_applied == 0) {
            $color_articles_count ++;
            $articles_filtered_by_color = $articles_filtered_by_size;
        }
        if ($color_articles_count == 0) {
            return collect([]);
        }

        // Filter remaining creations by shop. If no shop selected, keep all previous creations
        $articles_filtered_by_shop = collect([]);
        $shop_filters_applied = 0;
        $shop_articles_count = 0;
        foreach ($applied_filters['shops'] as $shop => $filter_value) {
            if ($filter_value == '1') {
                $shop_filters_applied ++;
                foreach ($articles_filtered_by_color as $article_checked_for_shop) {
                    $article_ok = 0;
                    foreach ($article_checked_for_shop->shops as $article_shop) {
                        if ($article_shop->filter_key == $shop) {
                            $article_ok = 1;
                        }
                    }
                    if ($article_ok == 1) {
                        $shop_articles_count ++;
                        $articles_filtered_by_shop->push($article_checked_for_shop);
                    }
                }
            }
         } 
        if ($shop_filters_applied == 0) {
            $shop_articles_count ++;
            $articles_filtered_by_shop = $articles_filtered_by_color;
        }
        if ($shop_articles_count == 0) {
            return collect([]);
        }
        
        $filtered_articles = $articles_filtered_by_shop;
        
        return $filtered_articles;
    }
}