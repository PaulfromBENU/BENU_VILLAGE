<?php

namespace App\Traits;

use App\Models\Article;
use App\Models\Creation;
use App\Models\Stock;

trait ArticleAnalyzer {

    public function stock(Article $article) 
    {
        $stock = 0;
        foreach ($article->shops as $shop) {
            $stock += $shop->pivot->stock;
        }

        return $stock;
    }

    public function getAvailableCreations($family = '')
    {
        switch ($family) {
            case 'clothes':
                $available_creations = Creation::where('is_accessory', '0')
                ->whereHas('creation_groups', function($query) {
                    $query->where('filter_key', '<>', 'home');
                })
                ->has('articles.available_shops')
                ->get();
                break;

            case 'accessories':
                $available_creations = Creation::where('is_accessory', '1')
                // ->whereHas('creation_groups', function($query) {
                //     $query->where('filter_key', '<>', 'home');
                // })
                ->has('articles.available_shops')->get();
                break;

            case 'home':
                $available_creations = Creation::query()
                ->whereHas('creation_groups', function($query) {
                    $query->where('filter_key', 'home');
                })
                ->has('articles.available_shops')->get();
                break;
            
            default:
                // has query will check for the existence of an article with an  available shop
                $available_creations = Creation::has('articles.available_shops')->get();
                break;
        }

        // $all_creations = Creation::all();
        // $available_creations = collect([]);

        // foreach ($all_creations as $creation) {
        //     if($this->checkIfHasArticlesInStock($creation)) {
        //         $available_creations->push($creation);
        //     }
        // }

        return $available_creations;
    }

    public function checkIfHasArticlesInStock(Creation $creation)
    {
        if ($creation->articles()->has('available_shops')->count() > 0) {
            return true;
        }

        return false;
        // foreach ($creation->articles as $article) {
        //     if ($article->available_shops()->count() > 0) {
        //         return true;
        //     }
        // }
        // return false;
    }

    public function getAvailableArticles(Creation $creation)
    {
        $available_articles = $creation->articles()->has('available_shops')->get();
        // $available_articles = collect([]);
        // $creation_full = Creation::find($creation->id);
        // foreach ($creation->articles as $article) {
        //     if ($article->shops()->wherePivot('stock', '>', '0')->count() > 0) {
        //         $available_articles->push($article);
        //     }
        // }
        
        // foreach ($creation->articles as $article) {
        //     if ($this->stock($article) > 0) {
        //         $available_articles->push($article);
        //     }
        // }

         return $available_articles;
    }

    public function getAvailableExtraAccessories(Creation $creation)
    {
        $available_articles = $creation->creation_accessories()->has('available_shops')->get();

         return $available_articles;
    }

    public function getAllAvailableArticles()
    {
        $available_articles = Article::has('available_shops')->get();
        // $available_articles = collect([]);

        // foreach (Article::all() as $article) {
        //     if ($article->shops()->wherePivot('stock', '>', '0')->count() > 0) {
        //         $available_articles->push($article);
        //     }
        // }

         return $available_articles;
    }

    public function getSoldArticles(Creation $creation)
    {
        $sold_articles = $creation->articles()->doesntHave('available_shops')->get();
        // $sold_articles = collect([]);
        // foreach ($creation->articles as $article) {
        //     if ($article->available_shops()->count() == 0) {
        //         $sold_articles->push($article);
        //     }
        // }
        // foreach ($creation->articles as $article) {
        //      if ($this->stock($article) == 0) {
        //          $sold_articles->push($article);
        //      }
        //  }

         return $sold_articles;
    }

    public function checkIfFilterHasArticles($filter, $filter_option) //Not used anymore!
    {
        switch ($filter) {
            case 'creation_category':
                if (Creation::where('creation_category_id', $filter_option->id)->count() > 0) {
                    foreach (Creation::where('creation_category_id', $filter_option->id)->get() as $creation) {
                        if ($this->checkIfHasArticlesInStock($creation)) {
                            return true; // To return true, at least one creation of the category must have available articles
                        }
                    }
                }
                return false;
                break;

            case 'creation_group':
                foreach (Creation::all() as $creation) {
                    if ($creation->creation_groups->contains($filter_option->id)) {
                        if ($this->checkIfHasArticlesInStock($creation)) {
                            return true; // To return true, at least one creation of the group must have available articles
                        }
                    }
                }
                // if (Creation::where('creation_group_id', $filter_option->id)->count() > 0) {
                //     foreach (Creation::where('creation_group_id', $filter_option->id)->get() as $creation) {
                //         if ($this->getAvailableArticles($creation)->count() > 0) {
                //             return true; // To return true, at least one creation of the group must have available articles
                //         }
                //     }
                // }
                return false;
                break;

            case 'colors':
                foreach (Creation::all() as $creation) {
                    foreach ($this->getAvailableArticles($creation) as $article) {
                        if ($article->color_id == $filter_option->id) {
                            return true; // To return true, at least one creation of the group must have available articles
                        }
                    }
                }
                return false;
                break;

            case 'prices':
                if ($filter_option == 'more') {
                    $min_price = 180;
                    $max_price = 1000000;
                } else {
                    $min_price = explode("-", $filter_option)[0];
                    $max_price = explode("-", $filter_option)[1];
                }
                if (Creation::where('price', '>=', $min_price)->where('price', '<', $max_price + 1)->count() > 0) {
                    foreach (Creation::where('price', '>=', $min_price)->where('price', '<', $max_price + 1)->get() as $creation) {
                        if ($this->checkIfHasArticlesInStock($creation)) {
                            return true; // To return true, at least one creation of the group must have available articles
                        }
                    }
                }
                return false;
                break;

            case 'partners':
                if (Creation::where('partner_id', $filter_option->id)->count() > 0) {
                    foreach (Creation::where('partner_id', $filter_option->id)->get() as $creation) {
                        if ($this->checkIfHasArticlesInStock($creation)) {
                            return true; // To return true, at least one creation of the group must have available articles
                        }
                    }
                }
                return false;
                break;

            case 'shops':
                foreach (Creation::all() as $creation) {
                    foreach ($this->getAvailableArticles($creation) as $article) {
                        foreach ($article->shops as $shop) {
                            if ($shop->id == $filter_option->id && $shop->pivot->stock > 0) {
                                return true; // To return true, at least one article of one creation must have a positive stock in the shop
                            }
                        }
                    }
                }
                return false;
                break;
            
            default:
                return true;
                break;
        }
    }

    public function checkIfArticleFilterHasArticles($creation, $filter, $filter_option)
    {
        switch ($filter) {
            case 'sizes':
                foreach ($this->getAvailableArticles($creation) as $article) {
                    if ($article->size_id == $filter_option->id) {
                        return true; // To return true, at least one creation of the group must have available articles
                    }
                }
                return false;
                break;

            case 'colors':
                foreach ($this->getAvailableArticles($creation) as $article) {
                    if ($article->color_id == $filter_option->id) {
                        return true; // To return true, at least one creation of the group must have available articles
                    }
                }
                return false;
                break;

            case 'shops':
                foreach ($this->getAvailableArticles($creation) as $article) {
                    foreach ($article->shops as $shop) {
                        if ($shop->id == $filter_option->id && $shop->pivot->stock > 0) {
                            return true; // To return true, at least one article of one creation must have a positive stock in the shop
                        }
                    }
                }
                return false;
                break;
            
            default:
                return true;
                break;
        }
    }

    public function checkIfSoldFilterHasArticles($creation, $filter, $filter_option)
    {
        switch ($filter) {
            case 'sizes':
                foreach ($this->getSoldArticles($creation) as $article) {
                    if ($article->size_id == $filter_option->id) {
                        return true; // To return true, at least one creation of the group must have available articles
                    }
                }
                return false;
                break;

            case 'colors':
                foreach ($this->getSoldArticles($creation) as $article) {
                    if ($article->color_id == $filter_option->id) {
                        return true; // To return true, at least one creation of the group must have available articles
                    }
                }
                return false;
                break;

            case 'shops':
                foreach ($this->getSoldArticles($creation) as $article) {
                    foreach ($article->shops as $shop) {
                        if ($shop->id == $filter_option->id) {
                            return true; // To return true, at least one article of one creation must have been sold in the shop
                        }
                    }
                }
                return false;
                break;
            
            default:
                return true;
                break;
        }
    }
}