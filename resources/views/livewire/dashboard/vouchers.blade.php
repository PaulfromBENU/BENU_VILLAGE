<div class="dashboard-vouchers">
    <h2>{{ __('dashboard.account-vouchers') }}</h2>
    
    <h3>{{ __('dashboard.vouchers-add-new') }}</h3>

    <form method="POST" wire:submit.prevent="addVoucher" class="dashboard-vouchers__form">
        @csrf

        <div class="dashboard-vouchers__form__input">
            <label for="voucher_code">{{ __('dashboard.vouchers-enter-code') }}</label><br/>
            <input type="text" name="voucher_code" wire:model="voucher_code" placeholder="XXXXXXXXXXXXXXXX" id="voucher_code" required>
            @if($message !== "")
            <p class="primary-color mt-1">
                <em>
                    {{ $message }}
                </em>
            </p>
            @endif
        </div>

        <div>
            <button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" style="margin-left: 0;" type="submit">
                {{ __('dashboard.vouchers-confirm-code') }}
            </button>
        </div>
    </form>

    <h3>{{ __('dashboard.vouchers-my-vouchers') }}</h3>

    <div class="flex justify-between flex-wrap">
    @foreach($vouchers as $voucher)
        <div class="dashboard-vouchers__voucher relative" wire:key="{{ $voucher->unique_code }}">
            <p class="dashboard-vouchers__voucher__code">
                N<sup>o</sup> {{ $voucher->unique_code }}
            </p>
            <p class="dashboard-vouchers__voucher__remaining">
               {{ __('dashboard.vouchers-remaining-value') }} : {{ $voucher->remaining_value }}&euro; 
            </p>
            <p>
                <a target="_blank" href="{{ route('show-voucher-pdf-'.app()->getLocale(), ['voucher_code' => \Illuminate\Support\Str::random(4).$voucher->unique_code.\Illuminate\Support\Str::random(12)]) }}" class="primary-color hover:underline">
                    {{ __('dashboard.vouchers-see-pdf') }}
                </a>
            </p>
            <button class="dashboard-vouchers__voucher__delete" wire:click="removeVoucher('{{ $voucher->unique_code }}')">
                &#10005;
            </button>
        </div>
    @endforeach
    </div>
</div>