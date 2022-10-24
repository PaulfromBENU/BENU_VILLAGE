<form method="POST" wire:submit.prevent="validateInfo" class="payment-tunnel__identification__field">
    @csrf
    <h4>{{ __('cart.info-required') }}</h4>
    <div class="mb-5">
        <div>
            <div class="flex flex-wrap justify-between">
                <div class="w-full lg:w-5/12 flex justify-start flex-wrap input-group register__form__radio-group">
                    <div class="mr-4">
                        <input type="radio" id="register_gender_male" name="register_gender" value="male" wire:model="gender">
                        <label for="register_gender_male" class="ml-2" style="color: #2E1414;">{{ __('forms.sir') }}</label><br>
                    </div>
                    <div class="mr-4">
                        <input type="radio" id="register_gender_female" name="register_gender" value="female" wire:model="gender">
                        <label for="register_gender_female" class="ml-2" style="color: #2E1414;">{{ __('forms.madam') }}</label><br>
                    </div>
                    <div>
                        <input type="radio" id="register_gender_neutral" name="register_gender" value="neutral" wire:model="gender">
                        <label for="register_gender_neutral" class="ml-2" style="color: #2E1414;">{{ __('forms.neutral') }}</label> 
                    </div>
                </div>
                <div class="w-full lg:w-5/12 input-group reactive-label-input mobile-hidden tablet-hidden">
                    
                </div>
            </div>

            <div class="flex flex-wrap justify-between">
                <div class="w-full lg:w-5/12 input-group reactive-label-input">
                    <label for="first-name">{{ __('forms.first-name') }} *</label>
                    <input type="text" id="first-name" name="first_name" class="input-underline w-full" tabindex="1" minlength="2" maxlength="255" wire:model="first_name" required>
                    @error('register_first_name')
                        <div class="primary-color">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full lg:w-5/12 input-group reactive-label-input">
                    <label>{{ __('forms.last-name') }} *</label>
                    <input type="text" name="register_last_name" class="input-underline w-full" tabindex="2" minlength="2" maxlength="255" wire:model="last_name" required>
                </div>
            </div>

            <div class="flex flex-wrap justify-between">
                <div class="w-full lg:w-5/12 input-group reactive-label-input">
                    <label>{{ __('forms.email') }} *</label>
                    <input type="email" name="email" class="input-underline w-full" tabindex="3" minlength="2" maxlength="255" wire:model="email" required>
                </div>
                
                <div class="w-full lg:w-5/12 input-group reactive-label-input">
                    <label>{{ __('forms.phone') }} *</label>
                    <input type="tel" name="register_phone" class="input-underline w-full" minlength="6" maxlength="30" tabindex="4" wire:model="phone" required>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-1">
        <label for="register_age" class="flex w-full" style="color: #2E1414; transform: scale(1);">
            <input id="register_age" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm" name="register_age" value="1" tabindex="5" wire:model="is_over_18" required style="margin-top: 6px;">
            <p class="ml-4 md:ml-10">{{ __('forms.register-major-conf') }} *</p>
        </label>
    </div>
    <div class="mb-3 mt-3">
        <label for="register_legal" class="flex w-full" style="color: #2E1414; transform: scale(1);">
            <input id="register_legal" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm" name="register_legal" value="1" tabindex="6" wire:model="accepts_conditions" required style="margin-top: 6px;">
            <p class="ml-4 md:ml-10">{!! __('forms.register-conditions-conf-1') !!} <a href="{{ route('footer.general-conditions-'.app()->getLocale()) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('forms.register-conditions-conf-2') !!}</a> {!! __('forms.register-conditions-conf-3') !!} <a href="{{ route('footer.policy-'.app()->getLocale()) }}" target="_blank" class="primary-color hover:text-gray-800 transition">{!! __('forms.register-conditions-conf-4') !!}</a> {!! __('forms.register-conditions-conf-5') !!} *</p>
        </label>
    </div>

    <p class="mb-5 mt-5" style="width: 100%;">
        <strong>{{ __('forms.personnal-data-info') }}</strong>
    </p>
    @if($duplicate_email_info == 1)
    <p class="primary-color">
        <strong>{{ __('forms.e-mail-already-exists-please-connect-or-change-email') }}</strong>
    </p>
    @endif
    <div class="flex flex-wrap justify-between mt-5">
        @if($duplicate_email_info !== 1)
        <div class="mt-3 md:mt-0 md:mr-5 m-auto md:ml-0">
            <button type="submit" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover">
                {{ __('cart.info-validate') }}
            </button>
        </div>
        @endif
        <a href="{{ route('login-'.app()->getLocale()) }}" class="btn-slider-left m-auto md:mr-3 mt-3 md:mt-0 mb-3 md:mb-0">
            {{ __('cart.info-connect') }}
        </a>
    </div>
</form>