<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Livewire\WithFileUploads;

use Intervention\Image\Facades\Image;

use App\Models\NewsArticleCouture;
use App\Models\NewsArticleElementCouture;

class WriteNews extends Page
{
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static string $view = 'filament.pages.write-news';

    protected static ?string $title = 'Write a new article';
 
    protected static ?string $navigationLabel = 'Write News';
     
    protected static ?string $slug = 'write-news';

    protected static ?string $navigationGroup = 'News and Medias';

    protected static ?int $navigationSort = 1;

    public $show_general_info = 0;
    public $show_article_content = 0;
    public $show_pending_articles = 0;
    public $show_online_articles = 0;
    public $number_of_elements = 0;
    public $article_id = 0;

    public $pending_articles;
    public $online_articles;

    public $article_title_fr = "";
    public $article_title_de = "";
    public $article_title_lu = "";
    public $article_title_en = "";

    public $article_slug_fr = "";
    public $article_slug_de = "";
    public $article_slug_lu = "";
    public $article_slug_en = "";

    public $article_tag_1_fr = "";
    public $article_tag_1_de = "";
    public $article_tag_1_lu = "";
    public $article_tag_1_en = "";

    public $article_tag_2_fr = "";
    public $article_tag_2_de = "";
    public $article_tag_2_lu = "";
    public $article_tag_2_en = "";

    public $article_tag_3_fr = "";
    public $article_tag_3_de = "";
    public $article_tag_3_lu = "";
    public $article_tag_3_en = "";

    public $article_summary_fr = "";
    public $article_summary_de = "";
    public $article_summary_lu = "";
    public $article_summary_en = "";

    public $article_seo_title_fr = "";
    public $article_seo_title_de = "";
    public $article_seo_title_lu = "";
    public $article_seo_title_en = "";

    public $article_seo_desc_fr = "";
    public $article_seo_desc_de = "";
    public $article_seo_desc_lu = "";
    public $article_seo_desc_en = "";

    public $element_types = [];
    public $element_contents_fr = [];
    public $element_contents_de = [];
    public $element_contents_lu = [];
    public $element_contents_en = [];
    public $element_photo_files = [];
    public $element_photo_alts = [];
    public $element_photo_titles = [];
    public $element_links = [];
    public $element_link_labels_fr = [];
    public $element_link_labels_de = [];
    public $element_link_labels_lu = [];
    public $element_link_labels_en = [];

    public $main_photo;

    public function mount()
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        $this->pending_articles = NewsArticleCouture::where('is_ready', '0')->orderBy('updated_at', 'desc')->get();
        $this->online_articles = NewsArticleCouture::where('is_ready', '1')->orderBy('updated_at', 'desc')->get();
    }

    public function fillArticleData($article_id)
    {
        // Update all fields upon selection of a specific article for update
        $this->article_id = $article_id;
        $news = NewsArticleCouture::find($article_id);
        $this->article_title_fr = $news->title_fr;
        $this->article_title_de = $news->title_de;
        $this->article_title_lu = $news->title_lu;
        $this->article_title_en = $news->title_en;

        $this->article_slug_fr = $news->slug_fr;
        $this->article_slug_de = $news->slug_de;
        $this->article_slug_lu = $news->slug_lu;
        $this->article_slug_en = $news->slug_en;

        $this->article_tag_1_fr = $news->tag_1_fr;
        $this->article_tag_1_de = $news->tag_1_de;
        $this->article_tag_1_lu = $news->tag_1_lu;
        $this->article_tag_1_en = $news->tag_1_en;

        $this->article_tag_2_fr = $news->tag_2_fr;
        $this->article_tag_2_de = $news->tag_2_de;
        $this->article_tag_2_lu = $news->tag_2_lu;
        $this->article_tag_2_en = $news->tag_2_en;

        // $this->article_tag_3_fr = $news->tag_3_fr;
        // $this->article_tag_3_de = $news->tag_3_de;
        // $this->article_tag_3_lu = $news->tag_3_lu;
        // $this->article_tag_3_en = $news->tag_3_en;

        $this->article_summary_fr = $news->summary_fr;
        $this->article_summary_de = $news->summary_de;
        $this->article_summary_lu = $news->summary_lu;
        $this->article_summary_en = $news->summary_en;

        $this->article_seo_title_fr = $news->seo_title_fr;
        $this->article_seo_title_de = $news->seo_title_de;
        $this->article_seo_title_lu = $news->seo_title_lu;
        $this->article_seo_title_en = $news->seo_title_en;

        $this->article_seo_desc_fr = $news->seo_desc_fr;
        $this->article_seo_desc_de = $news->seo_desc_de;
        $this->article_seo_desc_lu = $news->seo_desc_lu;
        $this->article_seo_desc_en = $news->seo_desc_en;

        $this->main_photo = $news->main_photo;

        for ($i=0; $i < $news->elements()->count(); $i++) { 
            $element = $news->elements()->where('position', $i + 1)->first();
            $this->element_types[$i] = $element->type;
            $this->element_contents_fr[$i] = $element->content_fr;
            $this->element_contents_de[$i] = $element->content_de;
            $this->element_contents_lu[$i] = $element->content_lu;
            $this->element_contents_en[$i] = $element->content_en;
            $this->element_photo_files[$i] = $element->photo_file_name;
            $this->element_photo_alts[$i] = $element->photo_alt;
            $this->element_photo_titles[$i] = $element->photo_title;
            $this->element_links[$i] = $element->link;
            $this->element_link_labels_fr[$i] = $element->link_label_fr;
            $this->element_link_labels_de[$i] = $element->link_label_de;
            $this->element_link_labels_en[$i] = $element->link_label_en;
            $this->element_link_labels_lu[$i] = $element->link_label_lu;

            $this->number_of_elements = $news->elements()->count();
        }

        if ($news->is_ready == 1) {
            $news->is_ready = 0;
            $news->save();
        }

        $this->refreshData();

        $this->show_pending_articles = 0;
        $this->show_online_articles = 0;
        $this->show_general_info = 1;
    }

    public function sendOnline($article_id)
    {
        $news = NewsArticleCouture::find($article_id);
        $news->is_ready = 1;
        if ($news->save()) {
            $this->refreshData();
            $this->show_pending_articles = 0;
            $this->show_online_articles = 1;
            $this->notify('success', 'The news was successfully published online :)');
        }
    }

    public function updatedMainPhoto()
    {
        $this->validate([
            'main_photo' => 'image|max:6144', // 6MB Max
        ]);
    }

    public function toggleGeneralInfo($value)
    {
        if (in_array($value, [0, 1])) {
            $this->show_general_info = $value;
        }
    }

    public function toggleArticleContent($value)
    {
        if (in_array($value, [0, 1])) {
            $this->show_article_content = $value;
        }
    }

    public function togglePendingArticles($value)
    {
        if (in_array($value, [0, 1])) {
            $this->show_pending_articles = $value;
        }
    }

    public function toggleOnlineArticles($value)
    {
        if (in_array($value, [0, 1])) {
            $this->show_online_articles = $value;
        }
    }

    public function addElement($type)
    {
        if (in_array($type, [0, 1, 2, 3, 4])) {
            $this->element_types[$this->number_of_elements] = $type;
            $this->createNewElement();
        }
    }

    public function createNewElement()
    {
        $this->element_contents_fr[$this->number_of_elements] = "";
        $this->element_contents_de[$this->number_of_elements] = "";
        $this->element_contents_lu[$this->number_of_elements] = "";
        $this->element_contents_en[$this->number_of_elements] = "";
        $this->element_photo_files[$this->number_of_elements] = null;
        $this->element_photo_alts[$this->number_of_elements] = "";
        $this->element_photo_titles[$this->number_of_elements] = "";
        $this->element_links[$this->number_of_elements] = "";
        $this->element_link_labels_fr[$this->number_of_elements] = "";
        $this->element_link_labels_de[$this->number_of_elements] = "";
        $this->element_link_labels_lu[$this->number_of_elements] = "";
        $this->element_link_labels_en[$this->number_of_elements] = "";

        $this->number_of_elements ++;

        $this->refreshData();
    }

    public function deleteElement($index)
    {
        unset($this->element_contents_fr[$index]);
        $this->element_contents_fr = array_values($this->element_contents_fr);

        unset($this->element_contents_de[$index]);
        $this->element_contents_de = array_values($this->element_contents_de);

        unset($this->element_contents_lu[$index]);
        $this->element_contents_lu = array_values($this->element_contents_lu);

        unset($this->element_contents_en[$index]);
        $this->element_contents_en = array_values($this->element_contents_en);

        unset($this->element_photo_files[$index]);
        $this->element_photo_files = array_values($this->element_photo_files);

        unset($this->element_photo_alts[$index]);
        $this->element_photo_alts = array_values($this->element_photo_alts);

        unset($this->element_photo_titles[$index]);
        $this->element_photo_titles = array_values($this->element_photo_titles);

        unset($this->element_links[$index]);
        $this->element_links = array_values($this->element_links);

        unset($this->element_link_labels_fr[$index]);
        $this->element_link_labels_fr = array_values($this->element_link_labels_fr);

        unset($this->element_link_labels_de[$index]);
        $this->element_link_labels_de = array_values($this->element_link_labels_de);

        unset($this->element_link_labels_lu[$index]);
        $this->element_link_labels_lu = array_values($this->element_link_labels_lu);

        unset($this->element_link_labels_en[$index]);
        $this->element_link_labels_en = array_values($this->element_link_labels_en);

        unset($this->element_types[$index]);
        $this->element_types = array_values($this->element_types);

        $this->number_of_elements --;
    }

    public function createNewArticle()
    {
        if ($this->article_id == 0) {
            $news = new NewsArticleCouture();
        } else {
            $news = NewsArticleCouture::find($this->article_id);
        }

        // General data creation or update
        $news->title_fr = $this->article_title_fr;
        $news->title_de = $this->article_title_de;
        $news->title_lu = $this->article_title_lu;
        $news->title_en = $this->article_title_en;

        $news->slug_fr = $this->article_slug_fr;
        $news->slug_de = $this->article_slug_de;
        $news->slug_lu = $this->article_slug_lu;
        $news->slug_en = $this->article_slug_en;

        if ($this->article_tag_1_en == ucfirst(strtolower(__('news.tag-events', [], 'en')))) {
            $this->article_tag_1_fr = ucfirst(strtolower(__('news.tag-events', [], 'fr')));
            $this->article_tag_1_de = ucfirst(strtolower(__('news.tag-events', [], 'de')));
            $this->article_tag_1_lu = ucfirst(strtolower(__('news.tag-events', [], 'lu')));
        } elseif ($this->article_tag_1_en == ucfirst(strtolower(__('news.tag-what-s-new', [], 'en')))) {
            $this->article_tag_1_fr = ucfirst(strtolower(__('news.tag-what-s-new', [], 'fr')));
            $this->article_tag_1_de = ucfirst(strtolower(__('news.tag-what-s-new', [], 'de')));
            $this->article_tag_1_lu = ucfirst(strtolower(__('news.tag-what-s-new', [], 'lu')));
        } elseif ($this->article_tag_1_en == ucfirst(strtolower(__('news.tag-environment', [], 'en')))) {
            $this->article_tag_1_fr = ucfirst(strtolower(__('news.tag-environment', [], 'fr')));
            $this->article_tag_1_de = ucfirst(strtolower(__('news.tag-environment', [], 'de')));
            $this->article_tag_1_lu = ucfirst(strtolower(__('news.tag-environment', [], 'lu')));
        } else {
            $this->article_tag_1_en = "";
            $this->article_tag_1_fr = "";
            $this->article_tag_1_de = "";
            $this->article_tag_1_lu = "";
        }
        $news->tag_1_en = $this->article_tag_1_en;
        $news->tag_1_fr = $this->article_tag_1_fr;
        $news->tag_1_de = $this->article_tag_1_de;
        $news->tag_1_lu = $this->article_tag_1_lu;

        if ($this->article_tag_2_en == ucfirst(strtolower(__('news.tag-events', [], 'en')))) {
            $this->article_tag_2_fr = ucfirst(strtolower(__('news.tag-events', [], 'fr')));
            $this->article_tag_2_de = ucfirst(strtolower(__('news.tag-events', [], 'de')));
            $this->article_tag_2_lu = ucfirst(strtolower(__('news.tag-events', [], 'lu')));
        } elseif ($this->article_tag_2_en == ucfirst(strtolower(__('news.tag-what-s-new', [], 'en')))) {
            $this->article_tag_2_fr = ucfirst(strtolower(__('news.tag-what-s-new', [], 'fr')));
            $this->article_tag_2_de = ucfirst(strtolower(__('news.tag-what-s-new', [], 'de')));
            $this->article_tag_2_lu = ucfirst(strtolower(__('news.tag-what-s-new', [], 'lu')));
        } elseif ($this->article_tag_2_en == ucfirst(strtolower(__('news.tag-environment', [], 'en')))) {
            $this->article_tag_2_fr = ucfirst(strtolower(__('news.tag-environment', [], 'fr')));
            $this->article_tag_2_de = ucfirst(strtolower(__('news.tag-environment', [], 'de')));
            $this->article_tag_2_lu = ucfirst(strtolower(__('news.tag-environment', [], 'lu')));
        } else {
            $this->article_tag_2_en = "";
            $this->article_tag_2_fr = "";
            $this->article_tag_2_de = "";
            $this->article_tag_2_lu = "";
        }
        $news->tag_2_en = $this->article_tag_2_en;
        $news->tag_2_fr = $this->article_tag_2_fr;
        $news->tag_2_de = $this->article_tag_2_de;
        $news->tag_2_lu = $this->article_tag_2_lu;

        if ($this->article_tag_3_en == ucfirst(strtolower(__('news.tag-events', [], 'en')))) {
            $this->article_tag_3_fr = ucfirst(strtolower(__('news.tag-events', [], 'fr')));
            $this->article_tag_3_de = ucfirst(strtolower(__('news.tag-events', [], 'de')));
            $this->article_tag_3_lu = ucfirst(strtolower(__('news.tag-events', [], 'lu')));
        } elseif ($this->article_tag_3_en == ucfirst(strtolower(__('news.tag-what-s-new', [], 'en')))) {
            $this->article_tag_3_fr = ucfirst(strtolower(__('news.tag-what-s-new', [], 'fr')));
            $this->article_tag_3_de = ucfirst(strtolower(__('news.tag-what-s-new', [], 'de')));
            $this->article_tag_3_lu = ucfirst(strtolower(__('news.tag-what-s-new', [], 'lu')));
        } elseif ($this->article_tag_3_en == ucfirst(strtolower(__('news.tag-environment', [], 'en')))) {
            $this->article_tag_3_fr = ucfirst(strtolower(__('news.tag-environment', [], 'fr')));
            $this->article_tag_3_de = ucfirst(strtolower(__('news.tag-environment', [], 'de')));
            $this->article_tag_3_lu = ucfirst(strtolower(__('news.tag-environment', [], 'lu')));
        } else {
            $this->article_tag_3_en = "";
            $this->article_tag_3_fr = "";
            $this->article_tag_3_de = "";
            $this->article_tag_3_lu = "";
        }
        $news->tag_3_en = $this->article_tag_3_en;
        $news->tag_3_fr = $this->article_tag_3_fr;
        $news->tag_3_de = $this->article_tag_3_de;
        $news->tag_3_lu = $this->article_tag_3_lu;
        

        $news->summary_fr = $this->article_summary_fr;
        $news->summary_de = $this->article_summary_de;
        $news->summary_lu = $this->article_summary_lu;
        $news->summary_en = $this->article_summary_en;

        $news->seo_title_fr = $this->article_seo_title_fr;
        $news->seo_title_de = $this->article_seo_title_de;
        $news->seo_title_lu = $this->article_seo_title_lu;
        $news->seo_title_en = $this->article_seo_title_en;

        $news->seo_desc_fr = $this->article_seo_desc_fr;
        $news->seo_desc_de = $this->article_seo_desc_de;
        $news->seo_desc_lu = $this->article_seo_desc_lu;
        $news->seo_desc_en = $this->article_seo_desc_en;

        // Main photo handling
        if($this->main_photo) {
            if(!is_string($this->main_photo)) {
                $img = Image::make($this->main_photo);
                $file_name = 'news-main-picture-'.$this->article_slug_en.'.'.$this->main_photo->getClientOriginalExtension();
                if ($img->width() < $img->height()) {
                    $img->rotate(90);
                }
                $img->resize(1000, 850, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                if($img->save(public_path('images/pictures/news/'.$file_name))) {
                    $news->main_photo = $file_name;
                }
            }
        }

        if ($news->save()) {
            if ($news->elements()->count() > 0) {
                $news->elements()->where('position', '>', $this->number_of_elements)->delete();
            }

            for ($i=0; $i < $this->number_of_elements; $i++) { 
                if ($news->elements()->where('position', $i + 1)->count() > 0) {
                    $element = $news->elements()->where('position', $i + 1)->first();
                } else {
                    $element = new NewsArticleElementCouture();
                    $element->position = $i + 1;
                    $element->news_article_id = $news->id;
                }
                $element->type = $this->element_types[$i];
                $element->content_fr = $this->element_contents_fr[$i];
                $element->content_de = $this->element_contents_de[$i];
                $element->content_lu = $this->element_contents_lu[$i];
                $element->content_en = $this->element_contents_en[$i];

                // New article photo handling
                if($this->element_photo_files[$i]) {
                    if(!is_string($this->element_photo_files[$i])) {
                        $img = Image::make($this->element_photo_files[$i]);
                        $file_name = 'news-additionnal-picture-'.$this->article_slug_en.'-'.$i.'.'.$this->element_photo_files[$i]->getClientOriginalExtension();
                        if ($img->width() < $img->height()) {
                            $img->rotate(90);
                        }
                        $img->resize(1000, 850, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });

                        if($img->save(public_path('images/pictures/news/'.$file_name))) {
                            $element->photo_file_name = $file_name;
                        }
                    }
                } else {
                    $element->photo_file_name = $this->element_photo_files[$i];
                }

                $element->photo_alt = $this->element_photo_alts[$i];
                $element->photo_title = $this->element_photo_titles[$i];

                $element->link = $this->element_links[$i];
                $element->link_label_fr = $this->element_link_labels_fr[$i];
                $element->link_label_de = $this->element_link_labels_de[$i];
                $element->link_label_lu = $this->element_link_labels_lu[$i];
                $element->link_label_en = $this->element_link_labels_en[$i];

                $element->save();
            }


            $this->resetExcept([
                'pending_articles', 
                'online_articles',
                'element_types',
                'element_contents_fr',
                'element_contents_de',
                'element_contents_lu',
                'element_contents_en',
                'element_photo_files',
                'element_photo_alts',
                'element_photo_titles',
                'element_links',
                'element_link_labels_fr',
                'element_link_labels_de',
                'element_link_labels_lu',
                'element_link_labels_en',
            ]);
            $this->refreshData();
            $this->notify('success', 'The news was successfully created :)');
            $this->show_pending_articles = 1;
        }
    }

    public function removeNews($article_id)
    {
        $news = NewsArticleCouture::find($article_id);
        $news->is_ready = 0;
        $news->save();
        $this->refreshData();
    }

    public function deleteNews($article_id)
    {
        $news = NewsArticleCouture::find($article_id);
        $news->delete();
        $this->refreshData();
    }
}
