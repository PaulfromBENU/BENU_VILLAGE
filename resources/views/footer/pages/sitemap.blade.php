@extends('layouts.base_layout')

@section('title')
	{{ __('footer.sitemap-title') }}
@endsection

@section('description')
	{{ __('footer.sitemap-desc') }}
@endsection

@section('breadcrumbs')
	<div class="breadcrumbs pattern-bg">
		<div class="benu-container breadcrumbs__content flex justify-start">
			<a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
			<div class="pl-5 pr-5">
				>
			</div>
			<a href="{{ route('footer.sitemap-'.app()->getLocale()) }}" class="primary-color"><strong>{{ __('breadcrumbs.sitemap') }}</strong></a>
		</div>
	</div>
@endsection

@section('main-content')
	<section class="sitemap">
		<div>
			<h1 class="sitemap__title">{{ __('footer.sitemap-title') }}</h1>
		</div>
		
		<div class="w-4/5 lg:w-1/2 m-auto">
			<ul>
				<li class="sitemap__list sitemap__list--large"><a href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('footer.sitemap-home') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('model-'.app()->getLocale(), ['family' => 'clothes']) }}">{{ __('footer.sitemap-all-clothes') }}</a></li>
				@foreach($clothes as $clothe)
					<li class="sitemap__list sitemap__list--small">
						<a href="{{ route('model-'.app()->getLocale(), ['name' => strtolower(str_replace(' ', '-', $clothe->name))]) }}">
							{{ __('footer.sitemap-single-clothe') }} {{ $clothe->name }}
						</a>
						<ul>
							@foreach($clothe->articles as $clothe_article)
							<li class="pl-3" style="font-size: 1rem;">
								<a href="{{ route('model-'.app()->getLocale(), ['name' => strtolower(str_replace(' ', '-', $clothe->name)), 'article' => strtolower($clothe_article->name)]) }}">
									{{ $clothe_article->name }}
								</a>
							</li>
							@endforeach
						</ul>
					</li>
				@endforeach

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('model-'.app()->getLocale(), ['family' => 'accessories']) }}">{{ __('footer.sitemap-all-accessories') }}</a></li>
				@foreach($accessories as $accessory)
					<li class="sitemap__list sitemap__list--small">
						<a href="{{ route('model-'.app()->getLocale(), ['name' => strtolower(str_replace(' ', '-', $accessory->name))]) }}">
							{{ __('footer.sitemap-single-clothe') }} {{ $accessory->name }}
						</a>
						<ul>
							@foreach($accessory->articles as $accessory_article)
							<li class="pl-3" style="font-size: 1rem;">
								<a href="{{ route('model-'.app()->getLocale(), ['name' => strtolower(str_replace(' ', '-', $accessory->name)), 'article' => strtolower($accessory_article->name)]) }}">
									{{ $accessory_article->name }}
								</a>
							</li>
							@endforeach
						</ul>
					</li>
				@endforeach

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('model-'.app()->getLocale(), ['family' => 'home']) }}">{{ __('footer.sitemap-all-home-items') }}</a></li>
				@foreach($home_items as $home_item)
					<li class="sitemap__list sitemap__list--small">
						<a href="{{ route('model-'.app()->getLocale(), ['name' => strtolower(str_replace(' ', '-', $home_item->name))]) }}">
							{{ __('footer.sitemap-single-clothe') }} {{ $home_item->name }}
						</a>
						<ul>
							@foreach($home_item->articles as $home_article)
							<li class="pl-3" style="font-size: 1rem;">
								<a href="{{ route('model-'.app()->getLocale(), ['name' => strtolower(str_replace(' ', '-', $home_item->name)), 'article' => strtolower($home_article->name)]) }}">
									{{ $home_article->name }}
								</a>
							</li>
							@endforeach
						</ul>
					</li>
				@endforeach

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('vouchers-'.app()->getLocale()) }}">{{ __('footer.sitemap-vouchers') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('about-'.app()->getLocale()) }}">{{ __('footer.sitemap-about-us') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('full-story-'.app()->getLocale()) }}">{{ __('footer.sitemap-full-story') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('client-service-'.app()->getLocale()) }}">{{ __('footer.sitemap-client-service') }}</a></li>
				<li class="sitemap__list sitemap__list--small">
					<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-faq')]) }}">
						{{ __('footer.sitemap-client-service-faq') }}
					</a>
				</li>
				<li class="sitemap__list sitemap__list--small">
					<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-delivery')]) }}">
						{{ __('footer.sitemap-client-service-delivery') }}
					</a>
				</li>
				<li class="sitemap__list sitemap__list--small">
					<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-sizes')]) }}">
						{{ __('footer.sitemap-client-service-sizes') }}
					</a>
				</li>
				<li class="sitemap__list sitemap__list--small">
					<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-return')]) }}">
						{{ __('footer.sitemap-client-service-return') }}
					</a>
				</li>
				<li class="sitemap__list sitemap__list--small">
					<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-payment')]) }}">
						{{ __('footer.sitemap-client-service-payment') }}
					</a>
				</li>
				<li class="sitemap__list sitemap__list--small">
					<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-care')]) }}">
						{{ __('footer.sitemap-client-service-care') }}
					</a>
				</li>
				<li class="sitemap__list sitemap__list--small">
					<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-shops')]) }}">
						{{ __('footer.sitemap-client-service-shops') }}
					</a>
				</li>
				<li class="sitemap__list sitemap__list--small">
					<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}">
						{{ __('footer.sitemap-client-service-contact') }}
					</a>
				</li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('news-'.app()->getLocale()) }}">{{ __('footer.sitemap-all-news') }}</a></li>
				@foreach($news as $single_news)
					<li class="sitemap__list sitemap__list--small">
						@php 
							$localized_slug = 'slug_'.app()->getLocale(); 
							$localized_title = 'title_'.app()->getLocale(); 
						@endphp
						<a href="{{ route('news-'.app()->getLocale(), ['slug' => $single_news->$localized_slug]) }}">
							{{ __('footer.sitemap-single-news') }} {{ $single_news->$localized_title }}
						</a>
					</li>
				@endforeach

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('cart-'.app()->getLocale()) }}">{{ __('footer.sitemap-cart') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('newsletter-'.app()->getLocale()) }}">{{ __('footer.sitemap-newsletter-subscribe') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('header.participate-'.app()->getLocale()) }}">{{ __('footer.sitemap-participate') }}</a></li>
				<li class="sitemap__list sitemap__list--small">
					<a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-badges')]) }}">
						{{ __('footer.sitemap-participate-badges') }}
					</a>
				</li>
				<li class="sitemap__list sitemap__list--small">
					<a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-give')]) }}">
						{{ __('footer.sitemap-participate-give') }}
					</a>
				</li>
				<li class="sitemap__list sitemap__list--small">
					<a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-partnership')]) }}">
						{{ __('footer.sitemap-participate-partnership') }}
					</a>
				</li>
				<li class="sitemap__list sitemap__list--small">
					<a href="{{ route('header.participate-'.app()->getLocale(), ['page' => __('slugs.participate-smart')]) }}">
						{{ __('footer.sitemap-participate-smart') }}
					</a>
				</li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('footer.legal-'.app()->getLocale()) }}">{{ __('footer.sitemap-legal-mentions') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('footer.policy-'.app()->getLocale()) }}">{{ __('footer.sitemap-policy') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('footer.general-info-'.app()->getLocale()) }}">{{ __('footer.sitemap-general-infos') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('footer.medias-'.app()->getLocale()) }}">{{ __('footer.sitemap-medias') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('campaigns-'.app()->getLocale()) }}">{{ __('footer.sitemap-all-campaigns') }}</a></li>
				<li class="sitemap__list sitemap__list--small"><a href="{{ route('campaign-single-'.app()->getLocale(), ['slug' => 'carte-blanche']) }}">{{ __('footer.sitemap-campaign-carte-blanche') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}">{{ __('footer.sitemap-dashboard') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('login-'.app()->getLocale()) }}">{{ __('footer.sitemap-login') }}</a></li>

				<li class="sitemap__list sitemap__list--large"><a href="{{ route('register-'.app()->getLocale()) }}">{{ __('footer.sitemap-register') }}</a></li>
			</ul>
		</div>
	</section>
@endsection

@section('scripts')
@endsection