<form method="POST" wire:submit.prevent="createNewAddress">
    @csrf
    <div class="register__address" style="margin-top: 0; margin-bottom: 0; background: transparent;">
        <h6 class="text-center" style="margin-bottom: 10px;">
            {{ __('forms.register-add-address') }}
        </h6>
        <div class="register__address__address-name" style="background: transparent; margin-bottom: 0px;">
            <div class="reactive-label-input">
                <label>
                    {{ __('forms.register-address-name') }} <span class="register_optionnal_star">*</span>
                </label>
                <input type="text" name="register_address_name" class="input-underline w-full register_address_field register_address_field_mandatory" style="color: black;" tabindex="7" maxlength="150" required wire:model="address_name">
                @error('address_name') <p class="primary-color"><em>{{ $message }}</em></p> @enderror
            </div>
            <!-- <p class="text-sm" style="color: darkgray;"><em>{{ __('forms.register-address-required') }}</em></p> -->
        </div>
        <div>
            <div class="flex justify-between flex-wrap">
                <div class="input-group reactive-label-input w-full lg:w-5/12">
                    <label>
                        {{ __('forms.first-name') }} <span class="register_optionnal_star">*</span>
                    </label>
                    <input type="text" name="register_address_first_name" class="input-underline w-full register_address_field register_address_field_mandatory" tabindex="8" maxlength="255" required wire:model="address_first_name">
                    @error('address_first_name') <p class="primary-color"><em>{{ $message }}</em></p> @enderror
                </div>
                <div class="input-group reactive-label-input w-full lg:w-5/12">
                    <label>
                        {{ __('forms.last-name') }} <span class="register_optionnal_star">*</span>
                    </label>
                    <input type="text" name="register_address_last_name" class="input-underline w-full register_address_field register_address_field_mandatory" tabindex="9" maxlength="255" required wire:model="address_last_name">
                    @error('address_last_name') <p class="primary-color"><em>{{ $message }}</em></p> @enderror
                </div>
            </div>
            <div class="flex justify-between flex-wrap">
                <div class="input-group reactive-label-input w-full lg:w-5/12">
                    <label>
                        {{ __('forms.register-address-street-number') }} <span class="register_optionnal_star">*</span>
                    </label>
                    <input type="text" name="register_address_number" class="input-underline w-full register_address_field register_address_field_mandatory" tabindex="10" required wire:model="address_street_number">
                    @error('address_street_number') <p class="primary-color"><em>{{ $message }}</em></p> @enderror
                </div>
                <div class="input-group reactive-label-input w-full lg:w-5/12">
                    <label>
                        {{ __('forms.register-address-street-name') }} <span class="register_optionnal_star">*</span>
                    </label>
                    <input type="text" name="register_address_street" class="input-underline w-full register_address_field register_address_field_mandatory" tabindex="11" maxlength="255" required wire:model="address_street">
                    @error('address_street') <p class="primary-color"><em>{{ $message }}</em></p> @enderror
                </div>
            </div>
            <div class="flex justify-between flex-wrap">
                <div class="input-group reactive-label-input w-full lg:w-5/12">
                    <label>
                        {{ __('forms.register-address-floor') }}
                    </label>
                    <input type="text" name="register_address_floor" class="input-underline w-full register_address_field" tabindex="12" maxlength="50" wire:model="address_floor">
                    @error('address_floor') <p class="primary-color"><em>{{ $message }}</em></p> @enderror
                </div>
                <div class="input-group reactive-label-input w-full lg:w-5/12">
                    <label>
                        {{ __('forms.register-address-zip') }} <span class="register_optionnal_star">*</span>
                    </label>
                    <input type="text" name="register_address_zip" class="input-underline w-full register_address_field register_address_field_mandatory" tabindex="13" maxlength="10" required wire:model="address_zip">
                    @error('address_zip') <p class="primary-color"><em>{{ $message }}</em></p> @enderror
                </div>
            </div>
            <div class="flex justify-between flex-wrap">
                <div class="input-group reactive-label-input w-full lg:w-5/12">
                    <label>
                        {{ __('forms.register-address-city') }} <span class="register_optionnal_star">*</span>
                    </label>
                    <input type="text" name="register_address_city" class="input-underline w-full register_address_field register_address_field_mandatory" tabindex="14" maxlength="150" required wire:model="address_city">
                    @error('address_city') <p class="primary-color"><em>{{ $message }}</em></p> @enderror
                </div>
                <div class="input-group reactive-label-input w-full lg:w-5/12">
                    <label>
                        {{ __('forms.register-address-phone') }} <span class="register_optionnal_star">*</span>
                    </label>
                    <input type="text" name="register_address_phone" class="input-underline w-full register_address_field register_address_field_mandatory" tabindex="15" maxlength="30" required wire:model="address_phone">
                    @error('address_phone') <p class="primary-color"><em>{{ $message }}</em></p> @enderror
                </div>
            </div>
        </div>
        <div class="w-full reactive-label-input">
            <label>
                {{ __('forms.register-address-country') }} <span class="register_optionnal_star">*</span>
            </label>
            <select name="register_address_country" class="input-underline w-full register_address_field register_address_field_mandatory" tabindex="16" maxlength="50" required wire:model="address_country" style="margin-top: 20px;">
                <optgroup label="{{ __('forms.select-country-region') }}">
                    <option value="LU" {{ old('register_address_country') === 'LU' ? 'selected' : '' }}>
                        {{ $nearby_countries->where('country_code', 'LU')->first()->$localized_country }}
                    </option>
                    <option value="BE" {{ old('register_address_country') === 'BE' ? 'selected' : '' }}>
                        {{ $nearby_countries->where('country_code', 'BE')->first()->$localized_country }}
                    </option>
                    <option value="FR" {{ old('register_address_country') === 'FR' ? 'selected' : '' }}>
                        {{ $nearby_countries->where('country_code', 'FR')->first()->$localized_country }}
                    </option>
                    <option value="DE" {{ old('register_address_country') === 'DE' ? 'selected' : '' }}>
                        {{ $nearby_countries->where('country_code', 'DE')->first()->$localized_country }}
                    </option>
                </optgroup>
                <optgroup label="{{ __('forms.select-country-europe') }}">
                    @foreach($country_options as $country)
                    <option value="{{ $country->country_code }}" {{ old('register_address_country') === $country->country_code ? 'selected' : '' }}>
                        {{ $country->$localized_country }}
                    </option>
                    @endforeach
                </optgroup>
            </select>
            @error('address_country') <p class="primary-color"><em>{{ $message }}</em></p> @enderror
        </div>

        <div class="w-full reactive-label-input" style="margin-top: 15px;">
            <label style="width: fit-content; white-space: nowrap;">
                {{ __('forms.register-address-other') }}
            </label>
            <input type="text" name="register_address_other" class="input-underline w-full register_address_field" tabindex="17" maxlength="255" wire:model="address_other">
        </div>
    </div>

    <div class="text-center">
        <button class="btn-couture-plain mb-5" style="height: fit-content;">{{ __('forms.address-add-new') }}</button>

        @auth
        <button class="btn-slider-left m-auto mt-5 font-semibold" wire:click.prevent="cancelForm">{{ __('cart.address-choose-existing') }}</button>
        @else
        <button class="btn-slider-left m-auto mt-5 font-semibold" wire:click.prevent="cancelForm">{{ __('cart.address-back') }}</button>
        @endauth
    </div>
</form>
