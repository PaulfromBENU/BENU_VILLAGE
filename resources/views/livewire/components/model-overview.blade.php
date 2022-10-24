<a href="{{ route('model-'.app()->getLocale(), ['name' => Str::of(strtolower($model->name))->slug('-')]) }}" class="block model-overview">
    <div class="model-overview__header flex justify-between">
        <div>
            <p class="model-overview__header__txt">
                {{ $model_category }}&nbsp;- {{ $available_articles_count }} {{ trans_choice('components.models-header', $available_articles_count) }}
            </p>
            <div class="flex flex-start">
                @foreach($available_colors as $id => $color)
                    @if($color == 'multicolored')
                        <div class="color-circle" wire:key="{{ $model->id }}-color-{{ $id }}">
                            <img src="{{ asset('media/pictures/multicolor.png') }}">
                        </div>
                    @else
                        <div class="color-circle color-circle--{{ $color }}" wire:key="{{ $model->id }}-color-{{ $id }}"></div>
                    @endif
                @endforeach
                <div class="color-circle"></div>
            </div>
        </div>

        <div class="model-overview__header__heart">
        </div>
    </div>
    <div class="model-overview__img-container">
        @if($model->partner != null)
        <div class="model-overview__img-container__partner-icon">
            <div class="model-overview__img-container__partner-icon__content flex justify-between">
                <div>
                    <p class="primary-color pl-2 pr-2 text-sm">
                        <strong>{{ $model->partner->name }}</strong>
                    </p>
                    <p class="pl-2 pr-2 text-sm">
                        <em>{{ __('components.partner') }}</em>
                    </p>
                </div>
                <div>
                    @svg('icon_partenaire')
                </div>
            </div>
        </div>
        @endif
        <img src="{{ asset('media/pictures/articles/'.$pictures[$current_picture_index]) }}" alt="Picture for creation {{ $model->name }}">
        @if($pictures->count() > 1)
            <div class="slider-arrow slider-arrow--color-2 slider-arrow--left" wire:click.prevent.stop="changePicture('left')">
                <i class="fas fa-chevron-left"></i>
            </div>
            <div class="slider-arrow slider-arrow--color-2 slider-arrow--right" wire:click.prevent.stop="changePicture('right')">
                <i class="fas fa-chevron-right"></i>
            </div>
        @endif
    </div>
    <div class="model-overview__footer flex justify-between">
        <p>
            {{ __('components.models-model') }} {{ strtoupper($model->name) }}
        </p>
        <p>
            @if(session('has_kulturpass') !== null)
            {{ round($model->price / 2, 2) }}&euro;
            @else
            {{ $model->price }}&euro;
            @endif
        </p>
    </div>
</a>