<div class="flex justify-start flex-wrap mb-10">
    @php
    $localized_tag_1 = "tag_1_".app()->getLocale();
    $localized_tag_2 = "tag_2_".app()->getLocale();
    $localized_tag_3 = "tag_3_".app()->getLocale();
    $localized_title = "title_".app()->getLocale();
    $localized_slug = "slug_".app()->getLocale();
    $localized_summary = "summary_".app()->getLocale();
    @endphp
    @if($all_news->count() == 0)
    <p class="text-xl text-center w-full">
        <em>{{ __('news.no-news-for-the-moment') }}</em>
    </p>
    @endif
    @foreach($all_news as $news)
    <a href="{{ route('news-'.app()->getLocale(), ['slug' => $news->$localized_slug]) }}" class="all-news__link" wire:key="news-{{ $news->id }}">
        <div class="all-news__link__img-container">
            <img src="{{ asset('media/pictures/news/'.$news->main_photo) }}" alt="Photo news" title="Photo news">
        </div>
        <div class="all-news__link__tags flex justify-start flex-wrap">
            @if($news->$localized_tag_1 !== '' && $news->$localized_tag_1 !== null)
            <div class="all-news__link__tags__tag">
                {{ $news->$localized_tag_1 }}
            </div>
            @endif
            @if($news->$localized_tag_2 !== '' && $news->$localized_tag_2 !== null)
            <div class="all-news__link__tags__tag">
                {{ $news->$localized_tag_2 }}
            </div>
            @endif
            @if($news->$localized_tag_3 !== '' && $news->$localized_tag_3 !== null)
            <div class="all-news__link__tags__tag">
                {{ $news->$localized_tag_3 }}
            </div>
            @endif
        </div>
        <h3 class="all-news__link__title">
            {{ $news->$localized_title }}
        </h3>
        <p class="all-news__link__date">
            {{ $news->created_at->format('d\/m\/Y') }}
        </p>
        <p class="all-news__link__summary">
            {{ $news->$localized_summary }}
        </p>
    </a>
    @endforeach
</div>
