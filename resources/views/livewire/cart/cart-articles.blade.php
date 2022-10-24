@if($couture_articles->count() == 0)
<div class="cart-content__articles">
    <p>
        <em>{{ __('cart.no-article-for-the-moment') }}...</em>
    </p>
    <p class="text-center mt-5 pt-5">
        <a href="{{ route('model-'.app()->getLocale()) }}" class="btn-couture">{{ __('welcome.last-link') }}</a>
    </p>
</div>
@else
<div class="cart-content__articles">
    <div class="grid grid-cols-8 cart-content__articles__header mobile-hidden tablet-hidden">
        <div class="col-span-1">
            {{ __('cart.title-article') }}
        </div>
        <div class="col-span-2">
            
        </div>
        <div class="text-center">
            {{ __('cart.title-size') }}
        </div>
        <div class="text-center">
            {{ __('cart.title-color') }}
        </div>
        <div class="text-center">
            {{ __('cart.title-number') }}
        </div>
        <div class="pl-1 text-center">
            {{ __('cart.title-price') }}
        </div>
        <div>
            
        </div>
    </div>

    @foreach($couture_articles as $article)
        @livewire('components.cart-article', ['article_id' => $article->id], key($article->id))
    @endforeach

    <div class="w-full cart-info-box flex justify-between mobile-hidden">
        <div class="cart-info-box__block">
            <h5>
                {{ __('cart.delivery-method') }}
            </h5>
            <div>
                <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-delivery')]) }}" class="btn-couture inline-block" style="margin: 0; max-width: 100%;">
                    {{ __('cart.delivery-estimate-cost') }}
                </a>
            </div>
        </div>
        <div class="cart-info-box__block">
            <h5>
                {!! __('cart.delivery-need-help') !!}
            </h5>
            <p>
                {{ __('cart.delivery-all-answers') }}&nbsp;<a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-faq')]) }}">{{ __('cart.faq') }}</a>
            </p>
            <p>
                {{ __('cart.delivery-can-contact-us') }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}">{{ __('cart.delivery-contact-us') }}</a>
            </p>
        </div>
    </div>
</div>
@endif
