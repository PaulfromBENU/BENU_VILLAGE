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
<!-- Stripe -->
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('robots-behaviour-top')
	noindex, nofollow
@endsection

@section('seo-keywords-top')
	@yield('seo-keywords')
@endsection

@section('header')
	<!-- Menu and Nav header -->
	@include('header.simplified_header')
@endsection

@section('modals')
	<!-- Opaque background -->
	<div id="modal-opacifier" class="modal-opacifier" style="display: none;"></div>

	<!-- Language selection -->
	@livewire('modals.lang-modal')

    <!-- Error messages -->
    @if ($errors->any())
    <div class="modal error-modal" id="error-modal" style="display: none;">
    	<div class="error-modal__close">&#10005;</div>
	    @foreach ($errors->all() as $error)
	    {{ $error }}
	    @endforeach
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
	@yield('main-content')
@endsection

@section('footer')
	@include('footer.footer')
@endsection

@section('scripts-top')
	@if($errors->any())
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
	@yield('scripts')
@endsection