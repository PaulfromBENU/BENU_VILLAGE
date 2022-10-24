@extends('layouts.base_layout')

@section('title')
	{{ __('campaigns.all-seo-title') }}
@endsection

@section('description')
	{{ __('campaigns.all-seo-desc') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('campaigns-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.campaigns-all') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
	<div class="text-center all-campaigns w-2/3 md:w-3/4 lg:w-2/3 m-auto">
		<h4 class="all-campaigns__subtitle">{{ __('campaigns.all-subtitle') }}</h4>
		<h1 class="all-campaigns__title">{{ __('campaigns.all-title') }}</h1>

		@include('includes.campaigns.overview', [
			"link" => route('campaign-single-'.app()->getLocale(), ['slug' => 'carte-blanche']), 
			"picture" => "BC_WS_Photos_PoliticalDeclaration_6.jpg", 
			"title" => __('campaigns.carte-blanche-title'), 
			"date" => __('campaigns.carte-blanche-date'), 
			"summary" => __('campaigns.carte-blanche-summary')
		])

		<!-- <div class="mt-10 mb-10 text-center">
			<a href="{{ route('campaign-single-'.app()->getLocale(), ['slug' => 'carte-blanche']) }}" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">Campagne Carte Blanche</a>
		</div> -->
	</div>
@endsection

@section('scripts')

@endsection