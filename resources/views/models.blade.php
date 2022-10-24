@extends('layouts.base_layout')

@section('title')
	{{ __('models.seo-title-all') }}
@endsection

@section('description')
	{{ __('models.seo-description-all') }}
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
			@if($family == 'clothes')
				<a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes']) }}" class="primary-color"><strong>{{ __('breadcrumbs.models-clothes') }}</strong></a>
			@elseif($family == 'accessories')
				<a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories']) }}" class="primary-color"><strong>{{ __('breadcrumbs.models-accessories') }}</strong></a>
			@else
				<a href="{{ route('model-'.app()->getLocale(), ['family' => 'home']) }}" class="primary-color"><strong>{{ __('breadcrumbs.models-home') }}</strong></a>
			@endif
		</div>
	</div>
@endsection

@section('main-content')
<section class="all-models" id="all-models">
	@livewire('filters.all-models-filter', ['filter_names' => $filter_names, 'initial_filters' => $initial_filters, 'family' => $family])
	@livewire('filters.filtered-models', ['initial_filters' => $initial_filters, 'family' => $family])
</section>
@endsection

@section('scripts')
<script type="text/javascript">
	$(function() {
		Livewire.on('filtersUpdated', function() {
			$('#filtered-creations').hide();
			$('#filter-update-loader').show();
			$('body').css('overflow-y', 'auto');
    		$('html').css('overflow-y', 'auto');
		});

		Livewire.on('pageChanged', function() {
			document.getElementById("all-models").scrollIntoView({ behavior: "smooth", block: "start" });
		});


		$('.all-models__mobile-menu__opacifier').hide();
		// $('.all-models__mobile-menu__sidebar').css('left', '100%');

		Livewire.on('showSortMobile', function() {
			$('.all-models__mobile-menu__opacifier').fadeIn();
			$('.all-models__mobile-menu__sidebar--sort').css('left', '12%');
			$('body').css('overflow-y', 'hidden');
        	$('html').css('overflow-y', 'hidden');
		});

		Livewire.on('showFiltersMobile', function() {
			$('.all-models__mobile-menu__opacifier').fadeIn();
			$('.all-models__mobile-menu__sidebar--filters').css('left', '12%');
			$('body').css('overflow-y', 'hidden');
        	$('html').css('overflow-y', 'hidden');
		});

		Livewire.on('resetMobileWindow', function() {
			$('.all-models__mobile-menu__opacifier').hide();
			$('.all-models__mobile-menu__sidebar').css('left', '100%');
			$('body').css('overflow-y', 'auto');
    		$('html').css('overflow-y', 'auto');
		});
	})
</script>
@endsection