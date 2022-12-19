<div>
    @php
        $localized_tag_1 = "tag_1_".app()->getLocale();
        $localized_tag_2 = "tag_2_".app()->getLocale();
        $localized_tag_3 = "tag_3_".app()->getLocale();
        $localized_title = "title_".app()->getLocale();
        $localized_slug = "slug_".app()->getLocale();
        $localized_summary = "summary_".app()->getLocale();
    @endphp

    <!-- VILLAGE News -->
    <h2 class="all-news__origin all-news__origin--village">
        BENU VILLAGE
    </h2>
    <div class="flex justify-start flex-wrap mb-10">
        @if($village_news->count() == 0)
        <p class="text-xl text-center w-full">
            <em>{{ __('news.no-news-for-the-moment') }}</em>
        </p>
        @endif
        @foreach($village_news as $single_village_news)
            <a href="{{ route('news-'.app()->getLocale(), ['origin' => 'village', 'slug' => $single_village_news->$localized_slug]) }}" class="all-news__link" wire:key="news-village-{{ $single_village_news->id }}">
            <div class="all-news__link__img-container">
                <img src="{{ asset('media/pictures/news/'.$single_village_news->main_photo) }}" alt="Photo news" title="Photo news">
            </div>
            <div class="all-news__link__tags flex justify-start flex-wrap">
                @if($single_village_news->$localized_tag_1 !== '' && $single_village_news->$localized_tag_1 !== null)
                <div class="all-news__link__tags__tag">
                    {{ $single_village_news->$localized_tag_1 }}
                </div>
                @endif
                @if($single_village_news->$localized_tag_2 !== '' && $single_village_news->$localized_tag_2 !== null)
                <div class="all-news__link__tags__tag">
                    {{ $single_village_news->$localized_tag_2 }}
                </div>
                @endif
            </div>
            <h3 class="all-news__link__title">
                {{ $single_village_news->$localized_title }}
            </h3>
            <p class="all-news__link__date">
                {{ $single_village_news->created_at->format('d\/m\/Y') }}
            </p>
            <p class="all-news__link__summary">
                {{ $single_village_news->$localized_summary }}
            </p>
        </a>
        @endforeach
    </div>


    <!-- COUTURE News -->
    <a href="https://couture.benu.lu/fr/actualites" target="_blank">
        <h2 class="all-news__origin all-news__origin--couture">
            BENU COUTURE
        </h2>
    </a>
    <div class="flex justify-start flex-wrap mb-10">
        @if($couture_news->count() == 0)
        <p class="text-xl text-center w-full">
            <em>{{ __('news.no-news-for-the-moment') }}</em>
        </p>
        @endif
        @foreach($couture_news as $single_couture_news)
            <a href="{{ route('news-'.app()->getLocale(), ['origin' => 'couture', 'slug' => $single_couture_news->$localized_slug]) }}" class="all-news__link" wire:key="news-{{ $single_couture_news->id }}">
            <div class="all-news__link__img-container">
                <img src="https://couture.benu.lu/images/pictures/news/{{ $single_couture_news->main_photo }}" alt="Photo news BENU" title="Photo news BENU">
            </div>
            <div class="all-news__link__tags flex justify-start flex-wrap">
                @if($single_couture_news->$localized_tag_1 !== '' && $single_couture_news->$localized_tag_1 !== null)
                <div class="all-news__link__tags__tag">
                    {{ $single_couture_news->$localized_tag_1 }}
                </div>
                @endif
                @if($single_couture_news->$localized_tag_2 !== '' && $single_couture_news->$localized_tag_2 !== null)
                <div class="all-news__link__tags__tag">
                    {{ $single_couture_news->$localized_tag_2 }}
                </div>
                @endif
                @if($single_couture_news->$localized_tag_3 !== '' && $single_couture_news->$localized_tag_3 !== null)
                <div class="all-news__link__tags__tag">
                    {{ $single_couture_news->$localized_tag_3 }}
                </div>
                @endif
            </div>
            <h3 class="all-news__link__title">
                {{ $single_couture_news->$localized_title }}
            </h3>
            <p class="all-news__link__date">
                {{ $single_couture_news->created_at->format('d\/m\/Y') }}
            </p>
            <p class="all-news__link__summary">
                {{ $single_couture_news->$localized_summary }}
            </p>
        </a>
        @endforeach
    </div>
</div>
