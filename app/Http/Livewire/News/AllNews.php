<?php

namespace App\Http\Livewire\News;

use Livewire\Component;

use App\Models\NewsArticleCouture;
use App\Models\VillageInfo;

class AllNews extends Component
{
    protected $listeners = ['tagFilterUpdate' => 'updateNews'];

    public $village_news;
    public $couture_news;

    public function mount()
    {
        $this->updateNews('none');
    }

    public function updateNews($tag)
    {
        // Tag in English used for filtering
        if ($tag !== 'none') {
            if(auth()->check() && auth()->user()->canCheckNews()) {
                $this->village_news = VillageInfo::query()
                            ->where('tag_1_'.session('locale'), $tag)
                            ->orWhere('tag_2_'.session('locale'), $tag)
                            ->orWhere('tag_3_'.session('locale'), $tag)
                            ->orderBy('updated_at', 'desc')
                            ->get();
                $this->couture_news = NewsArticleCouture::query()
                                ->where('tag_1_'.session('locale'), $tag)
                                ->orWhere('tag_2_'.session('locale'), $tag)
                                ->orWhere('tag_3_'.session('locale'), $tag)
                                ->orderBy('updated_at', 'desc')
                                ->get();
            } else {
                $this->village_news = VillageInfo::query()
                            ->where('tag_1_'.session('locale'), $tag)
                            ->orWhere('tag_2_'.session('locale'), $tag)
                            ->orWhere('tag_3_'.session('locale'), $tag)
                            ->where('is_ready', '1')
                            ->orderBy('updated_at', 'desc')
                            ->get();
                $this->couture_news = NewsArticleCouture::query()
                                ->where('tag_1_'.session('locale'), $tag)
                                ->orWhere('tag_2_'.session('locale'), $tag)
                                ->orWhere('tag_3_'.session('locale'), $tag)
                                ->where('is_ready', '1')
                                ->orderBy('updated_at', 'desc')
                                ->get();
            }
        } else {
            if(auth()->check() && auth()->user()->canCheckNews()) {
                $this->village_news = VillageInfo::query()
                                ->orderBy('updated_at', 'desc')
                                ->get();
                $this->couture_news = NewsArticleCouture::query()
                                ->orderBy('updated_at', 'desc')
                                ->get();
            } else {
                $this->village_news = VillageInfo::query()
                                ->where('is_ready', '1')
                                ->orderBy('updated_at', 'desc')
                                ->get();
                $this->couture_news = NewsArticleCouture::query()
                                ->where('is_ready', '1')
                                ->orderBy('updated_at', 'desc')
                                ->get();
            }
        }
    }

    public function render()
    {
        return view('livewire.news.all-news');
    }
}
