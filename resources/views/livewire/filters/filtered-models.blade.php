<div class="benu-container">
    @if($initial_load ==  0)
        <div class="filter-no-result text-center">
            <img src="{{ asset('media/loaders/load-animation-1.gif') }}" class="m-auto">
        </div>
    @elseif($sections_number == 0 || $filtered_models->count() == 0)
        <div class="filter-no-result">
            {{ __('models.filter-no-result') }}
        </div>
    @endif

    <div class="filter-no-result text-center" id="filter-update-loader" style="display: none; margin-bottom: 40px; text-align: center;">
        <img src="{{ asset('media/loaders/loader-square-red.gif') }}" style="height: 70px; margin: auto;" />
        <!-- Mise à jour en cours... -->
    </div>

    <div class="flex flex-wrap justify-start all-models__list" id="filtered-creations">
    @for($j = 0; $j < $sections_number; $j++)
        @foreach($displayed_models[$j] as $model)
            @livewire('components.model-overview', ['model' => $model], key($model->id))
        @endforeach
        
        @if($j == 0 && $sections_number == 2)
            @switch(fmod($paginate_page, 5))
                @case(1)
                <div class="all-models__list__separator all-models__list__separator--1 flex flex-col justify-center">
                @break
                
                @case(2)
                <div class="all-models__list__separator all-models__list__separator--2 flex flex-col justify-center">
                @break

                @case(3)
                <div class="all-models__list__separator all-models__list__separator--3 flex flex-col justify-center">
                @break

                @case(4)
                <div class="all-models__list__separator all-models__list__separator--4 flex flex-col justify-center">
                @break

                @case(0)
                <div class="all-models__list__separator all-models__list__separator--5 flex flex-col justify-center">
                @break

                @default
                <div class="all-models__list__separator all-models__list__separator--1">
            @endswitch
                <p class="all-models__list__separator__title">
                    @switch(fmod($paginate_page, 5))
                        @case(1)
                        {{ __('models.info-1-header') }}
                        @break
                        
                        @case(2)
                        <span style="color: white;">{{ __('models.info-2-header') }}</span>
                        @break

                        @case(3)
                        {{ __('models.info-3-header') }}
                        @break

                        @case(4)
                        {{ __('models.info-4-header') }}
                        @break

                        @case(0)
                        {{ __('models.info-5-header') }}
                        @break

                        @default
                        {{ __('models.info-1-header') }}
                    @endswitch
                </p>
                <!-- <p class="all-models__list__separator__subtitle">
                    @switch(fmod($paginate_page, 5))
                        @case(1)
                        {{ __('models.info-1-txt') }}
                        @break
                        
                        @case(2)
                        {{ __('models.info-2-txt') }}
                        @break

                        @case(3)
                        {{ __('models.info-3-txt') }}
                        @break

                        @case(4)
                        {{ __('models.info-4-txt') }}
                        @break

                        @case(0)
                        {{ __('models.info-5-txt') }}
                        @break

                        @default
                        {{ __('models.info-1-txt') }}
                    @endswitch
                </p> -->
            </div>
        @endif
    @endfor
    </div>

    @if($paginate_pages_count > 1)
    <div class="pagination-index flex justify-between">
        @if($paginate_page > 1)
            <div class="pagination-index__chevron pagination-index__chevron--left" wire:click="changePage('previous')">
                @svg('chevron-down')
            </div>
        @endif
        @for($index = 1; $index <= $paginate_pages_count; $index ++)
            @if($index == $paginate_page)
                <div class="pagination-index__index pagination-index__index--active" wire:click="changePage({{ $index }})">{{ $index }}</div>
            @else
                <div class="pagination-index__index" wire:click="changePage({{ $index }})">{{ $index }}</div>
            @endif
        @endfor
        @if($paginate_page !== $paginate_pages_count)
            <div class="pagination-index__chevron pagination-index__chevron--right" wire:click="changePage('next')">
                @svg('chevron-down')
            </div>
        @endif
    </div>
    @endif
</div>