@extends('layouts.base_layout')

@php
$localized_seo_title = "seo_title_".app()->getLocale();
$localized_seo_desc = "seo_desc_".app()->getLocale();
$localized_tag_1 = "tag_1_".app()->getLocale();
$localized_tag_2 = "tag_2_".app()->getLocale();
$localized_tag_3 = "tag_3_".app()->getLocale();
$localized_title = "title_".app()->getLocale();
$localized_slug = "slug_".app()->getLocale();
$localized_summary = "summary_".app()->getLocale();
$localized_content = "content_".app()->getLocale();
$localized_label = "link_label_".app()->getLocale();
@endphp

@section('title')
	{{ $news->$localized_seo_title }}
@endsection

@section('description')
	{{ $news->$localized_seo_desc }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start flex-wrap">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('news-all-'.app()->getLocale()) }}">{{ __('breadcrumbs.news') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('news-'.app()->getLocale(), ['origin' => $origin, 'slug' => $news->$localized_slug]) }}" class="primary-color"><strong>{{ $news->$localized_title }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
	<div class="text-center all-news md:w-4/5 lg:w-1/2 m-auto">
		<h4 class="single-news__subtitle">{{ __('news.news-small-title') }}</h4>
		<h1 class="single-news__title">{{ $news->$localized_title }}</h1>
		<h5 class="single-news__date">{{ $news->created_at->format('d\/m\/Y') }}</h5>

		<div class="mb-10 flex justify-center flex-wrap">
			@if($news->$localized_tag_1 !== null && $news->$localized_tag_1 !== "")
			<div class="all-news__link__tags__tag m-2">
				{{ $news->$localized_tag_1 }}
			</div>
			@endif
			@if($news->$localized_tag_2 !== null && $news->$localized_tag_2 !== "")
			<div class="all-news__link__tags__tag m-2">
				{{ $news->$localized_tag_2 }}
			</div>
			@endif
			@if($news->$localized_tag_3 !== null && $news->$localized_tag_3 !== "")
			<div class="all-news__link__tags__tag m-2">
				{{ $news->$localized_tag_3 }}
			</div>
			@endif
		</div>

		@if($origin == 'couture')
		<p class="single-news__img-container">
			<img src="https://couture.benu.lu/images/pictures/news/{{ $news->main_photo }}">
		</p>
		@else
		<p class="single-news__img-container">
			<img src="{{ asset('media/pictures/news/'.$news->main_photo) }}">
		</p>
		@endif

		@foreach($news->elements()->orderBy('position', 'asc')->get() as $element)
			@switch($element->type)
				@case('0')
					<p class="single-news__txt">
						{!! $element->$localized_content !!}
					</p>
				@break

				@case('1')
					<p class="single-news__highlight">
						{!! $element->$localized_content !!}
					</p>
				@break

				@case('2')
					<div class="single-news__link">
						<a href="{{ $element->link }}" target="_blank" rel="noreferrer" class="btn-couture">{{ $element->$localized_label }}</a>
					</div>
				@break

				@case('3')
					@if($origin == 'couture')
					<div class="single-news__img-container">
						<img src="https://couture.benu.lu/images/pictures/news/{{ $element->photo_file_name }}" alt="{{ $element->photo_alt }}" title="{{ $element->photo_title }}">
					</div>
					@else
					<div class="single-news__img-container">
						<img src="{{ asset('media/pictures/news/'.$element->photo_file_name) }}" alt="{{ $element->photo_alt }}" title="{{ $element->photo_title }}">
					</div>
					@endif
				@break

				@case('4')
					@if($origin == 'couture')
					<div class="single-news__img-container--portrait">
						<img src="https://couture.benu.lu/images/pictures/news/{{ $element->photo_file_name }}" alt="{{ $element->photo_alt }}" title="{{ $element->photo_title }}">
					</div>
					@else
					<div class="single-news__img-container--portrait">
						<img src="{{ asset('images/pictures/news/'.$element->photo_file_name) }}" alt="{{ $element->photo_alt }}" title="{{ $element->photo_title }}">
					</div>
					@endif
				@break

				@default
					<p class="single-news__txt">
						{!! $element->$localized_content !!}
					</p>
				@break
			@endswitch
		@endforeach

		<div class="single-news__prev-next flex justify-between flex-wrap">
			@if($previous_news !== null)
			<a class="single-news__prev-next__block justify-start" href="{{ route('news-'.app()->getLocale(), ['origin' => $origin, 'slug' => $previous_news->$localized_slug]) }}">
				<div class="single-news__prev-next__block__img-container">
					@if($origin == 'couture')
					<img src="https://couture.benu.lu/images/pictures/news/{{ $previous_news->main_photo }}" alt="{{ $previous_news->main_photo_alt }}" title="{{ $previous_news->main_photo_title }}" />
					@else
					<img src="{{ asset('media/pictures/news/'.$previous_news->main_photo) }}" alt="{{ $previous_news->main_photo_alt }}" title="{{ $previous_news->main_photo_title }}" />
					@endif
				</div>
				<div class="pl-4">
					<div class="flex justify-start mb-3">
						<p class="primary-color text-2xl font-light mr-3 single-news__prev-next__block__chevron single-news__prev-next__block__chevron--left">
							<
						</p>
						<p class="single-news__prev-next__block__text">
							{{ __('news.previous-article') }}
						</p>
					</div>
					<h3>
						{{ $previous_news->$localized_title }}
					</h3>
				</div>
			</a>
			@else
			<a class="block" style="width: 49%;"></a>
			@endif
			
			@if($next_news !== null)
			<a class="single-news__prev-next__block justify-end flex-row-reverse lg:flex-row" href="{{ route('news-'.app()->getLocale(), ['origin' => $origin, 'slug' => $next_news->$localized_slug]) }}">
				<div class="pr-0 pl-4 lg:pr-4 lg:pl-0">
					<div class="flex justify-start mb-3">
						<p class="single-news__prev-next__block__text">
							{{ __('news.next-article') }}
						</p>
						<p class="primary-color text-2xl font-light ml-3 single-news__prev-next__block__chevron single-news__prev-next__block__chevron--left">
							>
						</p>
					</div>
					<h3>
						{{ $next_news->$localized_title }}
					</h3>
				</div>
				<div class="single-news__prev-next__block__img-container">
					@if($origin == 'couture')
					<img src="https://couture.benu.lu/images/pictures/news/{{ $next_news->main_photo }}" alt="{{ $next_news->main_photo_alt }}" title="{{ $next_news->main_photo_title }}" />
					@else
					<img src="{{ asset('media/pictures/news/'.$next_news->main_photo) }}" alt="{{ $next_news->main_photo_alt }}" title="{{ $next_news->main_photo_title }}" />
					@endif
				</div>
			</a>
			@else
			<a class="block" style="width: 49%;"></a>
			@endif
		</div>

		<!-- <div class="single-news__backlink mt-10">
			<a href="{{ route('news-all-'.app()->getLocale()) }}" class="btn-couture">Toutes les actualités</a>
		</div> -->
	</div>
@endsection

@section('scripts')

@endsection