@extends('layouts.base_layout')

@section('title')
	{{ __('footer.general-conditions-seo-title') }}
@endsection

@section('description')
	{{ __('footer.general-conditions-seo-description') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('footer.general-conditions-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.general-conditions') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
	<section class="footer-conditions w-11/12 md:w-4/5 lg:w-3/4 m-auto">
		<h1 class="footer-conditions__title">{{ __('footer.general-conditions-title') }}</h1>
		<p class="footer-conditions__paragraph">
			{{ __('footer.general-conditions-txt-1') }}
		</p>
		<ul>
			<li class="flex footer-conditions__paragraph">@svg('puce_leaf') <p><a href="https://couture.benu.lu">{{ __('footer.general-conditions-link-1') }}</a> (<a href="https://www.benucouture.lu">{{ __('footer.general-conditions-link-2') }}</a>)</p></li>
			<li class="flex footer-conditions__paragraph">@svg('puce_leaf') <p><a href="https://www.benu.lu">{{ __('footer.general-conditions-link-3') }}</a></p></li>
		</ul>
		<p class="footer-conditions__paragraph">
			{{ __('footer.general-conditions-txt-2') }}
		</p>

		<p class="footer-conditions__paragraph">
			{{ __('footer.general-conditions-txt-3') }} <a href="https://www.benureuse.lu">{{ __('footer.general-conditions-link-4') }}</a> {{ __('footer.general-conditions-txt-4') }} <a href="https://www.benureuse.lu">{{ __('footer.general-conditions-link-4') }}</a> {{ __('footer.general-conditions-txt-5') }}
		</p>

		<h2 class="footer-conditions__subtitle">
			{{ __('footer.general-conditions-subtitle-1') }}
		</h2>
		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-1') }}
		</h3>
		@for($i = 1; $i <= 5; $i ++)
		<p class="footer-conditions__paragraph">
			{{ __('footer.general-conditions-txt-1-1-'.$i) }}
		</p>
		@endfor

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-2') }}
		</h3>
		<p class="footer-conditions__paragraph">
			{{ __('footer.general-conditions-txt-1-2-1') }}
		</p>
		<ul>
			@for($i = 1; $i <= 4; $i ++)
			<li class="flex footer-conditions__paragraph">@svg('puce_leaf') <p>{{ __('footer.general-conditions-txt-1-2-'.(1 + $i)) }}</p></li>
			@endfor
		</ul>

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-3') }}
		</h3>
		@for($i = 1; $i <= 3; $i ++)
		<p class="footer-conditions__paragraph">
			{{ __('footer.general-conditions-txt-1-3-'.$i) }}
		</p>
		@endfor

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-4') }}
		</h3>
		<p class="footer-conditions__paragraph">
			{{ __('footer.general-conditions-txt-1-4-1') }}
		</p>
		<ul>
			@for($i = 1; $i <= 2; $i ++)
			<li class="flex footer-conditions__paragraph">@svg('puce_leaf') <p> {{ __('footer.general-conditions-txt-1-4-'.(1 + $i)) }}</p></li>
			@endfor
		</ul>
		@for($i = 1; $i <= 4; $i ++)
			<p class="footer-conditions__paragraph">
				{{ __('footer.general-conditions-txt-1-4-'.(3 + $i)) }}
			</p>
		@endfor

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-5') }}
		</h3>
		<p class="footer-conditions__paragraph">
			{{ __('footer.general-conditions-txt-1-5-1') }}
		</p>
		<ul>
			@for($i = 1; $i <= 10; $i ++)
			<li class="footer-conditions__paragraph">
				<strong>{{ $i }}. </strong> {{ __('footer.general-conditions-txt-1-5-'.(1 + $i)) }}
			</li>
			@endfor
		</ul>
		@for($i = 1; $i <= 3; $i ++)
			<p class="footer-conditions__paragraph">
				{{ __('footer.general-conditions-txt-1-5-'.(11 + $i)) }}
			</p>
		@endfor

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-6') }}
		</h3>
		@for($i = 1; $i <= 2; $i ++)
			<p class="footer-conditions__paragraph">
				{{ __('footer.general-conditions-txt-1-6-'.$i) }}
			</p>
		@endfor

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-7') }}
		</h3>
		@for($i = 1; $i <= 3; $i ++)
			<p class="footer-conditions__paragraph">
				{{ __('footer.general-conditions-txt-1-7-'.$i) }}
			</p>
		@endfor

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-8') }}
		</h3>
		@for($i = 1; $i <= 6; $i ++)
			<p class="footer-conditions__paragraph">
				{{ __('footer.general-conditions-txt-1-8-'.$i) }}
			</p>
		@endfor

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-9') }}
		</h3>
		@for($i = 1; $i <= 3; $i ++)
			<p class="footer-conditions__paragraph">
				{{ __('footer.general-conditions-txt-1-9-'.$i) }}
			</p>
		@endfor

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-10') }}
		</h3>
		@for($i = 1; $i <= 5; $i ++)
			<p class="footer-conditions__paragraph">
				{{ __('footer.general-conditions-txt-1-10-'.$i) }}
			</p>
		@endfor

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-11') }}
		</h3>
		@for($i = 1; $i <= 7; $i ++)
			<p class="footer-conditions__paragraph">
				{{ __('footer.general-conditions-txt-1-11-'.$i) }}
			</p>
		@endfor

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-12') }}
		</h3>
		@for($i = 1; $i <= 11; $i ++)
			<p class="footer-conditions__paragraph">
				{!! __('footer.general-conditions-txt-1-12-'.$i) !!}
			</p>
		@endfor

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-13') }}
		</h3>
		@for($i = 1; $i <= 4; $i ++)
			@if($i == 1)
			<p class="footer-conditions__paragraph">
				{!! __('footer.general-conditions-txt-1-13-'.$i) !!} <a href="https://kulturpass.lu/" target="_blank" rel="noreferrer">{{ __('footer.general-conditions-link-6') }}</a> {!! __('footer.general-conditions-txt-1-13-'.($i + 1)) !!}
			</p>
			@php $i++ @endphp
			@else
			<p class="footer-conditions__paragraph">
				{!! __('footer.general-conditions-txt-1-13-'.$i) !!}
			</p>
			@endif

		@endfor

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-14') }}
		</h3>
		<p class="footer-conditions__paragraph">
			{!! __('footer.general-conditions-txt-1-14-1') !!}
		</p>

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-15') }}
		</h3>
		<p class="footer-conditions__paragraph">
			{!! __('footer.general-conditions-txt-1-15-1') !!}
		</p>
		<p class="footer-conditions__paragraph">
			{!! __('footer.general-conditions-txt-1-15-2') !!}
		</p>

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-16') }}
		</h3>
		<p class="footer-conditions__paragraph">
			{!! __('footer.general-conditions-txt-1-16-1') !!}
		</p>

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-1-17') }}
		</h3>
		<p class="footer-conditions__paragraph">
			{!! __('footer.general-conditions-txt-1-17-1') !!}
		</p>

		<h2 class="footer-conditions__subtitle">
			{{ __('footer.general-conditions-subtitle-2') }}
		</h2>
		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-2-1') }}
		</h3>
		<p class="footer-conditions__paragraph">
			{!! __('footer.general-conditions-txt-2-1-1') !!}
		</p>
		<p class="footer-conditions__paragraph">
			{!! __('footer.general-conditions-txt-2-1-2') !!}
		</p>

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-2-2') }}
		</h3>
		@for($i = 1; $i <= 3; $i ++)
			<p class="footer-conditions__paragraph">
				{!! __('footer.general-conditions-txt-2-2-'.$i) !!}
			</p>
		@endfor

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-2-3') }}
		</h3>
		<p class="footer-conditions__paragraph">
			{!! __('footer.general-conditions-txt-2-3-1') !!}
		</p>

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-2-4') }}
		</h3>
		<p class="footer-conditions__paragraph">
			{!! __('footer.general-conditions-txt-2-4-1') !!}
		</p>
		<p class="footer-conditions__paragraph">
			{!! __('footer.general-conditions-txt-2-4-2') !!}
		</p>

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-2-5') }}
		</h3>
		<p class="footer-conditions__paragraph">
			{!! __('footer.general-conditions-txt-2-5-1') !!}
		</p>

		<h3 class="footer-conditions__lowtitle">
			{{ __('footer.general-conditions-lowtitle-2-6') }}
		</h3>
		<p class="footer-conditions__paragraph">
			{!! __('footer.general-conditions-txt-2-6-1') !!}
		</p>
		<p class="footer-conditions__paragraph">
			{!! __('footer.general-conditions-txt-2-6-2') !!}
		</p>
	</section>
@endsection

@section('scripts')
@endsection