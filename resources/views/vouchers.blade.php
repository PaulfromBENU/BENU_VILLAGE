@extends('layouts.base_layout')

@section('title')
	{{ __('vouchers.seo-title') }}
@endsection

@section('description')
	{{ __('vouchers.seo-description') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('vouchers-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.vouchers') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
	@include('includes.vouchers.voucher_desc')
	@include('includes.vouchers.voucher_options')
@endsection

@section('side_modal')
	@livewire('modals.voucher-sidebar', ['voucher_id' => '0'])
@endsection

@section('scripts')
@endsection