@extends('layouts.base_layout')

@section('title')
	{{ __('models.sold-seo-title', ['name' => $model_name]) }}
@endsection

@section('description')
	{{ __('models.sold-seo-desc') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('model-'.app()->getLocale()) }}">{{ __('breadcrumbs.models') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('model-'.app()->getLocale(), ['name' => strtolower($model_name)]) }}">{{ __('breadcrumbs.model') }} {{ ucwords($model_name) }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('sold-'.app()->getLocale(), ['name' => strtolower($model_name)]) }}" class="primary-color"><strong>{{ __('breadcrumbs.sold') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
	<section class="sold">
		<div>
			<h1 class="sold__title">{{ __('models.sold-title') }} {{ ucfirst($model_name) }}</h1>
		</div>
		<p class="model-sold__subtitle w-1/2 m-auto">
			{{ __('models.sold-txt-1') }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" class="primary-color hover:text-gray-800 transition">{{ __('models.sold-txt-1-link') }}</a>
		</p>
		<div>
			@livewire('filters.sold-articles-filter', ['filter_names' => $filter_names, 'initial_filters' => $initial_filters])

			<div>
				@livewire('filters.filtered-sold-articles', ['creation' => $model, 'initial_filters' => $initial_filters])
				<div class="sold__link text-center">
					<a href="{{ route('model-'.app()->getLocale(), ['name' => strtolower($model_name)]) }}" class="btn-slider-left m-auto block">
						{{ __('models.sold-back-link') }} {{ strtoupper($model_name) }}
					</a>
				</div>
			</div>
		</div>
		@include('includes.model.model_request')
	</section>
@endsection

@section('side_modal')
	@livewire('modals.article-sidebar', ['article_id' => '0'])
@endsection

@section('scripts')
@endsection