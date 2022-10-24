<?php

namespace App\Http\Livewire\News;

use Livewire\Component;

use App\Models\NewsArticle;

class AllNews extends Component
{
    protected $listeners = ['tagFilterUpdate' => 'updateNews'];

    public $all_news;

    public function updateNews($tag)
    {
        // Tag in English used for filtering
        if ($tag !== 'none') {
            $this->all_news = NewsArticle::query()
                            ->where('tag_1_'.session('locale'), $tag)
                            ->orWhere('tag_2_'.session('locale'), $tag)
                            ->orWhere('tag_3_'.session('locale'), $tag)
                            ->where('is_ready', '1')
                            ->orderBy('updated_at', 'desc')
                            ->get();
        } else {
            $this->all_news = NewsArticle::query()
                            ->where('is_ready', '1')
                            ->orderBy('updated_at', 'desc')
                            ->get();
        }
    }

    public function render()
    {
        return view('livewire.news.all-news');
    }
}
