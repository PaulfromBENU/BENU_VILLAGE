<form method="POST" action="" id="contact-form" class="contact__form__form w-full m-auto mb-10" wire:submit.prevent="sendMessage" @if($safety_check == 0) onsubmit="event.preventDefault();" @endif>
    @csrf
    <div>
        <div class="flex justify-center lg:justify-between flex-wrap">
            <div class="flex justify-start input-group contact__form__radio-group w-full lg:w-5/12">
                <div class="mr-5 ml-1">
                    <input type="radio" id="contact_gender_male" name="gender" value="male" wire:model="gender">
                    <label for="contact_gender_male" class="ml-4">{{ __('forms.sir') }}</label><br>
                </div>
                <div class="mr-5">
                    <input type="radio" id="contact_gender_female" name="gender" value="female" wire:model="gender">
                    <label for="contact_gender_female" class="ml-4">{{ __('forms.madam') }}</label><br>
                </div>
                <div>
                    <input type="radio" id="contact_gender_neutral" name="gender" value="neutral" wire:model="gender">
                    <label for="contact_gender_neutral" class="ml-4">{{ __('forms.neutral') }}</label> 
                </div>
            </div>
            <div class="input-group reactive-label-input w-full lg:w-5/12">
                @if($company != "")
                    <label class="reactive-label-input__label-active">{{ __('forms.company') }}</label>
                @else
                    <label>{{ __('forms.company') }}</label>
                @endif
                <input type="text" name="company" class="input-underline w-full" maxlength="100" wire:model.defer="company">
            </div>
        </div>

        <div class="flex justify-center lg:justify-between flex-wrap">
            <div class="input-group reactive-label-input w-full lg:w-5/12">
                @if($first_name != "")
                    <label for="contact_first_name" class="reactive-label-input__label-active">{{ __('forms.first-name') }} *</label>
                @else
                    <label for="contact_first_name">{{ __('forms.first-name') }} *</label>
                @endif
                <input type="text" id="contact_first_name" name="first_name" class="input-underline w-full" tabindex="1" minlength="2" maxlength="255" required wire:model.defer="first_name">
                @error('first_name')
                    <div class="primary-color">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group reactive-label-input w-full lg:w-5/12">
                @if($last_name != "")
                    <label class="reactive-label-input__label-active">{{ __('forms.last-name') }} *</label>
                @else
                    <label>{{ __('forms.last-name') }} *</label>
                @endif
                <input type="text" name="last_name" class="input-underline w-full" tabindex="2" minlength="2" maxlength="255" required wire:model="last_name">
            </div>
        </div>

        <div class="flex justify-center lg:justify-between flex-wrap">
            <div class="input-group reactive-label-input w-full lg:w-5/12">
                @if($contact_email != "")
                    <label class="reactive-label-input__label-active">{{ __('forms.email') }} *</label>
                @else
                    <label>{{ __('forms.email') }} *</label>
                @endif
                <input type="email" name="contact_email" class="input-underline w-full" tabindex="3" minlength="2" maxlength="255" required wire:model.defer="contact_email">
            </div>
            <div class="input-group reactive-label-input w-full lg:w-5/12">
                @if($phone != "")
                    <label class="reactive-label-input__label-active">{{ __('forms.phone') }}</label>
                @else
                    <label>{{ __('forms.phone') }}</label>
                @endif
                <input type="text" name="phone" class="input-underline w-full" minlength="6" maxlength="30" tabindex="4" wire:model="phone">
            </div>
        </div>
    </div>
    <div class="mt-10 mb-10" style="position: relative;">
        <label style="position: absolute; top: 10px; left: 20px;">{{ __('forms.message') }} *</label>
        <textarea minlength="1" maxlength="2000" rows="8" class="w-full" tabindex="5" wire:model="message">
                
        </textarea>
        <p class="contact__form__form__mandatory">
            * {{ __('forms.mandatory-fields') }}
        </p>
        <div class="register__options">
            <label for="contact_agreement" class="inline-flex items-center contact__form__form__select">
                <input id="contact_agreement" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm" name="conditions_ok" value="1" tabindex="6" style="margin-top: 2px;" wire:model="conditions_ok" wire:click="restoreButton">
                <span class="ml-8">{{ __('forms.personal-data-agreement') }} *</span>
            </label>
        </div>
    </div>

    @if(!$message_sent)
        @if(!$safety_check)
        <div class="contact__form__form__security w-5/6 lg:w-2/3 m-auto justify-between">
            <div class="w-full text-center mb-3 md:mb-5">
                <p class="mb-3 md:mb-4">{!! __('forms.security-question') !!}</p>
                <div class="flex justify-center m-auto">
                    <p class="text-center mr-1" >
                        {{ $checksum_number_1 }} + {{ $checksum_number_2 }} =&nbsp;
                    </p>
                    <div class="text-center">
                        <input type="text" minlength="1" maxlength="2" class="ml-2 mr-2 input-underline rounded" required wire:model.defer="user_sum" style="height: 40px; border: solid 1px lightgrey; width: 50px; margin-top: 4px;">
                    </div>
                    <p class="ml-1">
                        &nbsp;?
                    </p>
                </div>
            </div>

            <div wire:click="checkSum" class="contact__form__form__security__btn btn-couture-plain" style="max-width: 250px;">{{ __('forms.check') }}</div>
        </div>
        @elseif($safety_check == 1)
        <input type="submit" name="contact_submit" value="{{ __('forms.send-message') }}" class="btn-couture-plain" style="height: 50px;">
        @endif
    @else
        @if($message_valid)
            <div class="contact__form__valid">
                {{ $submit_feedback }}
            </div>
        @else
            <div class="contact__form__invalid">
                {{ $submit_feedback }}
            </div>
        @endif
    @endif
</form>
