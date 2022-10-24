@extends('layouts.base_layout')

@section('title')
	{{ __('partners.seo-title') }}
@endsection

@section('description')
	{{ __('partners.seo-description') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('partners-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.partners') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
	<section class="partners flex justify-start lg:justify-between flex-col lg:flex-row benu-container">
		<div class="w-full lg:w-1/5">
			<h2 class="partners__side-title">{{ __('partners.title') }}</h2>
			<p class="partners__side-txt">
				{{ __('partners.side-txt') }}
			</p>
		</div>
		<div class="w-full lg:w-9/12 flex flex-col md:flex-row lg:flex-col flex-wrap">
			@foreach($partners as $partner)
			<div class="partners__box flex flex-col lg:flex-row justify-start">
				<div class="partners__box__img-container">
					<img src="{{ asset('media/pictures/partners/'.$partner->picture) }}">
				</div>
				<div class="partners__box__txt-container">
					<div class="flex justify-start lg:justify-between flex-col lg:flex-row">
						<h3 class="partners__box__title">{{ $partner->name }}</h3>
						<p>
							<a href="{{ route('model-'.app()->getLocale(), ['partners' => $partner->filter_key]) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover inline-block">{{ __('partners.see-articles-link') }}</a>
						</p>
					</div>
					<p class="partners__box__desc">
						{{ $partner->$desc_query }}
					</p>
					<div class="text-left partners__box__highlight">
						<div class="flex justify-start flex-wrap mb-2 lg:mb-0">
							<p class="w-full lg:w-7/12 mb-2">
								<strong>{!! __('partners.address') !!}:</strong> {{ $partner->address }}
							</p>
							<p>
								<strong>{!! __('partners.email') !!}:</strong> <span class="primary-color"><a href="mailto:{{ $partner->email }}" class="partners__box__link" target="_blank" rel="noreferrer">{{ $partner->email }}</a></span>
							</p>
						</div>
						<div class="flex justify-start flex-wrap">
							<p class="w-full lg:w-7/12 mb-2 lg:mb-0">
								<strong>{!! __('partners.phone') !!}:</strong> {{ $partner->phone }}
							</p>
							<p>
								<strong>{!! __('partners.website') !!}:</strong> <span class="primary-color"><a href="https://{{ $partner->website }}" class="partners__box__link" target="_blank" rel="noreferrer">{{ $partner->website }}</a></span>
							</p>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</section>
@endsection

@section('scripts')

@endsection