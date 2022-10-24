<?php

namespace App\Http\Livewire\News;

use Livewire\Component;

use App\Models\NewsArticle;

class TagFilters extends Component
{
    public $all_tags;
    public $active_tag;

    public function mount()
    {
        $all_news = NewsArticle::query()
                    ->where('is_ready', '1')
                    ->orderBy('updated_at', 'desc')
                    ->get();

        $this->localized_tag_1 = 'tag_1_'.session('locale');
        $this->localized_tag_2 = 'tag_2_'.session('locale');
        $this->localized_tag_3 = 'tag_3_'.session('locale');

        $localized_tag_1 = $this->localized_tag_1;
        $localized_tag_2 = $this->localized_tag_2;
        $localized_tag_3 = $this->localized_tag_3;

        $this->all_tags = [];

        foreach ($all_news as $news) {
            if (!in_array($news->$localized_tag_1, $this->all_tags)) {
                if ($news->$localized_tag_1 !== "") {
                    array_push($this->all_tags, $news->$localized_tag_1);
                }
            }
            if (!in_array($news->$localized_tag_2, $this->all_tags)) {
                if ($news->$localized_tag_2 !== "") {
                    array_push($this->all_tags, $news->$localized_tag_2);
                }
            }
            if (!in_array($news->$localized_tag_3, $this->all_tags)) {
                if ($news->$localized_tag_3 !== "") {
                    array_push($this->all_tags, $news->$localized_tag_3);
                }
            }
        }

        $this->active_tag = -1;
    }

    public function filterByTag($tag, $index)
    {
        if ($index == $this->active_tag) {
            $this->active_tag = -1;
            $this->emit('tagFilterUpdate', 'none');
        } else {
            $this->active_tag = $index;
            $this->emit('tagFilterUpdate', $tag);
        }
    }

    public function render()
    {
        return view('livewire.news.tag-filters');
    }
}
