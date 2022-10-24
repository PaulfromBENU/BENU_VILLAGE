<div class="items-sidebar flex flex-col lg:flex-row justify-start lg:justify-right relative">
    <div class="article-sidebar__img-container tablet-hidden">
        <div style="height: 100%;">
        @foreach($pictures as $picture)
            <img src="{{ asset('media/pictures/articles/'.$picture) }}" alt="Photo {{ $creation_name }}" class="w-full">
        @endforeach
        </div>
        @if(count($pictures) > 1)
        <div class="article-sidebar__img-container__scroller flex justify-between">
            <p>{{ __('sidebar.see-pictures') }}</p>
            <p>
                @svg('model_arrow_down')
            </p>
        </div>
        @endif
    </div>

    <!-- Mobile only -->
    <div class="article-sidebar__img-container-mobile relative mobile-only">
            <div class="flex justify-between absolute" style="width: 70%; left: 15%; bottom: 20px;">
                <div class="article-sidebar__img-container-mobile__arrow article-sidebar__img-container-mobile__arrow--left">
                    @svg('chevron-down')
                </div>
                <div class="article-sidebar__img-container-mobile__arrow article-sidebar__img-container-mobile__arrow--right">
                    @svg('chevron-down')
                </div>
            </div>

            <div class="flex justify-start article-sidebar__img-container-mobile__images">
                @foreach($pictures as $picture)
                    <img src="{{ asset('media/pictures/articles/'.$picture) }}" alt="Photo {{ $creation_name }}" class="w-full">
                @endforeach
            </div>
    </div>

    @if(in_array(app()->getLocale(), ['lu', 'de']))
        <div class="article-sidebar__content__close-container article-sidebar__content__close-container--large mobile-only" wire:click="closeSideBar">
            <div class="article-sidebar__content__close article-sidebar__content__close--large">
                {{ __('sidebar.close') }} <span class="pl-2">&#10005;</span>
            </div>
        </div>
        @else
        <div class="article-sidebar__content__close-container mobile-only" wire:click="closeSideBar">
            <div class="article-sidebar__content__close">
                {{ __('sidebar.close') }} <span class="pl-2">&#10005;</span>
            </div>
        </div>
    @endif

    <div class="article-sidebar__content">
        @if(in_array(app()->getLocale(), ['lu', 'de']))
        <div class="article-sidebar__content__close-container article-sidebar__content__close-container--large tablet-hidden" wire:click="closeItemsSideBar">
            <div class="article-sidebar__content__close article-sidebar__content__close--large">
                {{ __('sidebar.close') }} <span class="pl-2">&#10005;</span>
            </div>
        </div>
        @else
        <div class="article-sidebar__content__close-container tablet-hidden" wire:click="closeItemsSideBar">
            <div class="article-sidebar__content__close">
                {{ __('sidebar.close') }} <span class="pl-2">&#10005;</span>
            </div>
        </div>
        @endif

        <h3 class="article-sidebar__content__subtitle mb-10">
            {{ __('sidebar.mask-subtitle') }}
        </h3>
        <div class="article-sidebar__content__size">
            {{ strtoupper(__('models.unique-size')) }}
        </div>

        <h2 class="article-sidebar__content__title">
            {{ ucfirst(strtolower($creation_name)) }}
        </h2>

        <p class="article-sidebar__content__price">
            {{ $creation_price }}&euro;
        </p>

        <!-- <p class="article-sidebar__content__singularity">
            <span class="primary-color">{!! __('sidebar.singularity') !!}</span> {{ __('sidebar.items-singularity') }}
        </p> -->

        <form method="POST" wire:submit.prevent="submitItemsRequest">
            @csrf

            <div class="flex justify-start mt-10 mb-5">
                <h4 class="article-sidebar__content__mask-subtitle">
                    {{ __('models.masks-quantity') }}:
                </h4>
                <p class="article-sidebar__content__mask-number ml-5">
                    x {{ $items_number }}
                </p>
                <div class="ml-5 flex flex-row lg:flex-col">
                    <p class="article-sidebar__content__mask-btn" wire:click.prevent.stop="updateItemsNumber('up')">
                        <i class="fas fa-plus"></i>
                    </p>
                    <p class="article-sidebar__content__mask-btn" wire:click.prevent.stop="updateItemsNumber('down')">
                        <i class="fas fa-minus"></i>
                    </p>
                </div>
                <input type="hidden" name="items_number" wire:model="items_number">
            </div>

            <h4 class="article-sidebar__content__mask-subtitle">
                {{ __('sidebar.items-demand') }}:
            </h4>
            <textarea minlength="5" maxlength="1000" rows="4" name="item_text_request" class="w-full article-sidebar__content__mask-textarea" wire:model="text_demand"></textarea>

            <h4 class="article-sidebar__content__mask-subtitle mt-8">
                * {{ __('sidebar.items-email') }}:
            </h4>
            @auth
            <input type="email" name="item_email" value="{{ Auth::user()->email }}" class="article-sidebar__content__mask-email" wire:model="email">
            @else
            <input type="email" name="item_email" class="article-sidebar__content__mask-email" wire:model="email">
            @endauth

            <div class="mt-8 article-sidebar__content__mask-photos">
                <label for="mask_photos" class="inline-flex items-center">
                    <input id="mask_photos" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm" name="mask_photos" wire:model="with_pictures">
                    <span class="ml-6">{{ __('sidebar.masks-photos') }}</span>
                </label>
            </div>

            <div class="mt-8">
                @if($status == 'pending' && ($email == null || strpos($email, '@') == false))
                <div class="btn-couture-plain btn-couture-plain--dark-hover w-full pt-2" style="height: 50px; margin: 0; background: grey; border-color: grey;">
                    {{ __('sidebar.items-send-request') }}
                </div>
                @elseif($status == 'pending' && strpos($email, '@') !== false)
                <button type="submit" class="btn-couture-plain btn-couture-plain--dark-hover w-full" style="height: 50px; margin: 0;">
                    {{ __('sidebar.items-send-request') }}
                </button>
                @elseif($status == 'sent')
                <div class="article-sidebar__content__valid">
                    {!! __('sidebar.items-sent-confirm') !!}
                </div>
                @endif
            </div>

            <p class="article-sidebar__content__contact mt-6 mb-10">
                {!! __('sidebar.questions') !!} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" target="_blank" class="primary-color">{{ __('sidebar.contact-us') }}</a>
            </p>
        </form>
    </div>
</div>
