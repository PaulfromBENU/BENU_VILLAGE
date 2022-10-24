<?php

namespace App\Http\Livewire\Medias;

use Livewire\Component;
use App\Models\Media;

class MediaLinks extends Component
{
    public $media_type;
    public $cards_number;
    public $total_count;

    public function mount()
    {
        $this->cards_number = 6;
        $this->total_count = 0;
    }

    public function displayMoreCards()
    {
        $this->cards_number += 6;
    }

    public function render()
    {
        switch ($this->media_type) {
            case 'newspapers':
                $this->total_count = Media::where('family', 'newspapers')->orderBy('publication_date', 'desc')->count();
                return view('livewire.medias.media-links', ['medias' => Media::where('family', 'newspapers')->orderBy('publication_date', 'desc')->limit($this->cards_number, 0)->get()]);
                break;

            case 'radio':
                $this->total_count = Media::where('family', 'radio')->orderBy('publication_date', 'desc')->count();
                return view('livewire.medias.media-links', ['medias' => Media::where('family', 'radio')->orderBy('publication_date', 'desc')->limit($this->cards_number, 0)->get()]);
                break;

            case 'video':
                $this->total_count = Media::where('family', 'video')->orderBy('publication_date', 'desc')->count();
                return view('livewire.medias.media-links', ['medias' => Media::where('family', 'video')->orderBy('publication_date', 'desc')->limit($this->cards_number, 0)->get()]);
                break;

            case 'web':
                $this->total_count = Media::where('family', 'web')->orderBy('publication_date', 'desc')->count();
                return view('livewire.medias.media-links', ['medias' => Media::where('family', 'web')->orderBy('publication_date', 'desc')->limit($this->cards_number, 0)->get()]);
                break;
            
            default:
                $this->total_count = Media::orderBy('publication_date', 'desc')->count();
                return view('livewire.medias.media-links', ['medias' => Media::orderBy('publication_date', 'desc')->limit($this->cards_number, 0)->get()]);
                break;
        }
    }
}
