<div class="flex justify-start flex-wrap media-links">
    @if($medias == null || $medias->count() == 0)
        {{ __('footer.medias-no-media-for-the-moment') }}
    @else
        @foreach($medias as $media)
            @if($media->doc_name !== null && $media->doc_name !== "")
                <a href="{{ asset($media->doc_name) }}" class="media-links__card" download>
            @else
                <a href="{{ $media->link }}" target="_blank" rel="noreferrer" class="media-links__card">
            @endif
                    <div class="media-links__card__icon">
                        @if($media->family == 'newspapers')
                            @svg('benu_couture_icon_media_journal', 'media-links__card__icon__svg')
                        @elseif($media->family == 'radio')
                            @svg('benu_couture_icon_radio_journal', 'media-links__card__icon__svg')
                        @elseif($media->family == 'video')
                            @svg('benu_couture_icon_video_journal', 'media-links__card__icon__svg')
                        @elseif($media->family == 'web')
                            @svg('benu_couture_icon_web_journal', 'media-links__card__icon__svg')
                        @else
                            @svg('benu_couture_icon_media_journal', 'media-links__card__icon__svg')
                        @endif
                    </div>
                    <h3>
                        {{ $media->title }}
                    </h3>
                    <p class="media-links__card__subtxt">
                        {{ Carbon\Carbon::parse($media->publication_date)->format('m.Y') }}
                        @if($media->editor !== null) | {{ ucfirst($media->editor) }}@endif
                    </p>
                    <div class="media-links__card__language">
                        {{ $media->language }}
                    </div>
                </a>
        @endforeach

        @if($total_count > $cards_number)
            <div class="media-links__more w-full">
                <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover m-auto" wire:click="displayMoreCards">
                    {{ __('footer.medias-show-more') }}
                </button>
            </div>
        @endif
    @endif
</div>
