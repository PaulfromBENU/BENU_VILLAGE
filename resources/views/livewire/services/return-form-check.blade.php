<div class="text-center mt-5 pt-5">
    <a href="{{ route('return-'.app()->getLocale(), ['order_code' => 0]) }}" target="_blank" class="inline-block btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">{!! __('services.return-btn-pdf') !!}</a>

    <p class="mt-5 mb-5 font-semibold">
        {{ __('services.or-fill') }}
    </p>

    @if(!$is_checked)
        <form action="POST" wire:submit.prevent="checkInputs" class="flex justify-center flex-wrap return__form">
            @csrf
            <div class="return__form__fieldset">
                <label>{{ __('services.order') }}</label><br/>
                <input type="text" name="order_id" wire:model.defer="order_id" minlength="6" maxlength="6" placeholder="{{ __('services.order') }}" required>
            </div>
            <div class="return__form__fieldset">
                <label>{{ __('services.email') }}</label><br/>
                <input type="email" name="email" wire:model.defer="email" placeholder="{{ __('services.email') }}" required>
            </div>
            <div class="return__form__fieldset">
                <label></label><br/>
                <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">{{ __('services.find-order') }}</button>
            </div>
        </form>
    @else
        @php
        $codes = ['nykul3', '7intxw', 'Xnik7b', '12liug', '09baf9', 'kEH76f', 'oiGfz6'];
        @endphp
        <a href="{{ route('return-'.app()->getLocale(), ['order_code' => \Illuminate\Support\Str::random(4).$codes[rand(0, 6)].$order_id.\Illuminate\Support\Str::random(12)]) }}" target="_blank" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">{!! __('services.return-btn-pdf-prefilled') !!}</a>
    @endif

    @if($message !== "")
        <p class="primary-color">
            {{ $message }}
        </p>
    @endif
</div>
