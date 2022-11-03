@extends('layouts.html_general_layout')

@section('og-metadata-top')
	@yield('og-metadata')
	@sectionMissing('og-metadata')
        <meta property="og:title" content="@yield('title-top')" />
        <meta property="og:url" content="{{ url()->full() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:description" content="@yield('description')" />
        <meta property="og:image" content="{{ asset('media/benu_landing_illustration.svg') }}" />
        <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
    @endif
@endsection

@section('title-top')
	@yield('title')
@endsection

@section('description-top')
	@yield('description')
@endsection

@section('more-styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('js/services/slick-1.8.1/slick/slick.css') }}"/>
@endsection

@section('robots-behaviour-top')
	@if(App::environment('stage'))
		noindex, nofollow
	@else
		@yield('robots-behaviour', 'index, follow')
	@endif
@endsection

@section('seo-keywords-top')
	@yield('seo-keywords')
@endsection

@section('header')
	<!-- Harmonica menu -->
    @include('header.harmonica_menu')
	
	<!-- Menu and Nav header -->
	@include('header.general_header')
@endsection

@section('modals')
	<!-- Opaque background -->
	<div id="modal-opacifier" class="modal-opacifier" style="display: none;"></div>

	<!-- Language selection -->
	<div class="benu-container">
		@livewire('modals.lang-modal')
	</div>

	<!-- Search bar -->
	@if(1 == 0)
	@include('modals.search_modal')
	@endif

	<!-- Connection form -->
	@include('modals.connect_modal')

	<!-- Central Modal -->
    <div class="modal general-modal" id="general-modal" style="display: none;">
        @yield('modal')
    </div>

    <!-- Central Info Modal -->
    <div class="modal general-modal" id="info-modal" style="display: none;">
        @yield('info-modal')
    </div>

    <!-- Side modal -->
    <div class="modal side-modal" id="general-side-modal" style="display: none;">
        @yield('side_modal')
    </div>

    <!-- Error messages -->
    @if ($errors->any() || session('account-deleted') !== null)
    <div class="modal error-modal" id="error-modal" style="display: none;">
    	<div class="error-modal__close">&#10005;</div>
    	@if(session('account-deleted') !== null)
    	{{ session('account-deleted') }}
    	@endif
	    @foreach ($errors->all() as $error)
	    {{ $error }}
	    @endforeach
    </div>
   	@endif

   	<!-- Success messages -->
    @if (session('success') !== null)
    <div class="modal success-modal" id="success-modal" >
    	<div class="success-modal__close">&#10005;</div>
    	{{ session('success') }}
    </div>
   	@endif

   	<!-- Dashboard add address modal -->
   	@if(Route::currentRouteName() == 'dashboard')
   	<div class="add-address-modal-container" style="display: none;">
   		@livewire('dashboard.addresses-modal')
   	</div>
    @endif

@endsection

@section('main-content-top')
	@yield('breadcrumbs')
	@yield('main-content')
@endsection

@section('footer')
	@include('footer.connect')
	<!-- @include('footer.learn_more') -->
	@include('footer.more_questions')
	@include('footer.all_infos')
	@include('footer.footer')
@endsection

@section('scripts-top')
	<script type="text/javascript" src="{{ asset('js/services/slick-1.8.1/slick/slick.min.js') }}"></script>
	@if ($errors->any() || session('account-deleted') !== null)
	<script type="text/javascript">
		$(function() {
			$('#modal-opacifier').fadeIn('fast');
			$('#error-modal').fadeIn();
			$('.error-modal__close').on('click', function() {
				$('#modal-opacifier').fadeOut('fast');
				$('#error-modal').fadeOut('fast');
			});
		});
	</script>
	@endif
	@if (session('success') !== null)
	<script type="text/javascript">
		$(function() {
			$('#modal-opacifier').fadeIn('fast');
			$('#success-modal').fadeIn();
			$('.success-modal__close').on('click', function() {
				$('#modal-opacifier').fadeOut('fast');
				$('#success-modal').fadeOut('fast');
			});
		});
	</script>
	@endif
	@yield('scripts')
@endsection

