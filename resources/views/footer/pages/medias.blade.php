@extends('layouts.base_layout')

@section('title')
	{{ __('footer.medias-seo-title') }}
@endsection

@section('description')
	{{ __('footer.medias-seo-description') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('footer.medias-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.medias') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
	<section class="footer-medias w-4/5 lg:w-1/2 m-auto">
		<h3 class="footer-medias__subtitle">{{ __('footer.medias-subtitle') }}</h3>
		<h1 class="footer-medias__title" id="medias-title">{{ __('footer.medias-title') }}</h1>
		<ul class="media-links__accordion">
			<li>
				<div class="media-links__accordion__header flex justify-between">
					<p class="media-links__accordion__header__title">{{ __('footer.medias-section-title-1') }}</p>
					<p class="media-links__accordion__header__arrow flex flex-col justify-center">
						<img src="{{ asset('media/pictures/chevron_bottom_white.png') }}" class="media-links__accordion__header__chevron">
					</p>
				</div>

				<div class="media-links__accordion__answer mb-10" style="display: none; margin-bottom: 40px;">
					@livewire('medias.media-links', ['media_type' => "newspapers"])
				</div>
			</li>

			<li>
				<div class="media-links__accordion__header flex justify-between">
					<p class="media-links__accordion__header__title">{{ __('footer.medias-section-title-2') }}</p>
					<p class="media-links__accordion__header__arrow flex flex-col justify-center">
						<img src="{{ asset('media/pictures/chevron_bottom_white.png') }}" class="media-links__accordion__header__chevron">
					</p>
				</div>

				<div class="media-links__accordion__answer mb-10" style="display: none; margin-bottom: 40px;">
					@livewire('medias.media-links', ['media_type' => "radio"])
				</div>
			</li>

			<li>
				<div class="media-links__accordion__header flex justify-between">
					<p class="media-links__accordion__header__title">{{ __('footer.medias-section-title-3') }}</p>
					<p class="media-links__accordion__header__arrow flex flex-col justify-center">
						<img src="{{ asset('media/pictures/chevron_bottom_white.png') }}" class="media-links__accordion__header__chevron">
					</p>
				</div>

				<div class="media-links__accordion__answer" style="display: none; margin-bottom: 40px;">
					@livewire('medias.media-links', ['media_type' => "video"])
				</div>
			</li>

			<li>
				<div class="media-links__accordion__header flex justify-between">
					<p class="media-links__accordion__header__title">{{ __('footer.medias-section-title-4') }}</p>
					<p class="media-links__accordion__header__arrow flex flex-col justify-center">
						<img src="{{ asset('media/pictures/chevron_bottom_white.png') }}" class="media-links__accordion__header__chevron">
					</p>
				</div>

				<div class="media-links__accordion__answer" style="display: none; margin-bottom: 40px;">
					@livewire('medias.media-links', ['media_type' => "web"])
				</div>
			</li>
		</ul>

		<p class="footer-medias__paragraph text-center pl-10 pr-10">
			{{ __('footer.medias-txt-final') }}
		</p>
		<div class="text-center">
			<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" class="btn-couture btn-couture-plain--fit m-auto">{{ __('footer.medias-contact') }}</a>
		</div>
	</section>
@endsection

@section('scripts')
@endsection