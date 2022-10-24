<div class="dashboard-details">
	<h2>{{ __('dashboard.account-details') }}</h2>
	<div>
		<form method="POST" wire:submit.prevent="updatePersonalData" enctype="multipart/form-data">
			@csrf
			<div>
                <div class="w-full flex justify-center lg:justify-between flex-wrap">
                    <div class="flex justify-start input-group register__form__radio-group pl-2 w-full lg:w-5/12">
                        <div class="mr-7">
                            <input type="radio" id="register_gender_male" name="gender" value="male" wire:model.defer="gender">
                            <label for="register_gender_male" class="ml-1">{{ __('forms.sir') }}</label><br>
                        </div>
                        <div class="mr-7">
                            <input type="radio" id="register_gender_female" name="gender" value="female" wire:model.defer="gender">
                            <label for="register_gender_female" class="ml-1">{{ __('forms.madam') }}</label><br>
                        </div>
                        <div class="mr-7">
                            <input type="radio" id="register_gender_neutral" name="gender" value="neutral" wire:model.defer="gender">
                            <label for="register_gender_neutral" class="ml-1">{{ __('forms.neutral') }}</label> 
                        </div>
                    </div>
                    <div class="input-group reactive-label-input w-full lg:w-5/12">
                        <label>{{ __('forms.company') }}</label>
                        <input type="text" name="company" class="input-underline w-full" maxlength="255" wire:model.defer="company">
                    </div>
                </div>

                <div class="w-full flex justify-center lg:justify-between flex-wrap">
                    <div class="input-group reactive-label-input w-full lg:w-5/12">
                        <label for="first_name">{{ __('forms.first-name') }}</label>
                        <input type="text" id="first_name" name="first_name" class="input-underline w-full" tabindex="1" minlength="2" maxlength="255" wire:model.defer="first_name">
                        @error('first_name')
                            <div class="primary-color">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group reactive-label-input w-full lg:w-5/12">
                        <label>{{ __('forms.last-name') }}</label>
                        <input type="text" name="last_name" class="input-underline w-full" tabindex="2" minlength="2" maxlength="255" wire:model.defer="last_name">
                    </div>
                </div>

                <div class="w-full flex justify-center lg:justify-between flex-wrap">
                    <div class="input-group reactive-label-input w-full lg:w-5/12">
                        <label>{{ __('forms.email') }}</label>
                        <input type="email" name="email" class="input-underline w-full" tabindex="3" minlength="2" maxlength="255" wire:model.defer="email">
                    </div>
                    <div class="input-group reactive-label-input w-full lg:w-5/12">
                        <label>{{ __('forms.phone') }}</label>
                        <input type="text" name="phone" class="input-underline w-full" minlength="6" maxlength="30" tabindex="4" wire:model.defer="phone">
                    </div>
                </div>
            </div>

            <div class="flex justify-between flex-wrap mt-10">
                <div class="w-full lg:w-5/12 pb-5">
                	<h4>{{ __('dashboard.update-password') }}</h4>
                	<div class="input-group reactive-label-input w-full">
	                    <label style="color: black;">{{ __('dashboard.old-password-label') }}</label>
	                    <input type="password" name="old_password" class="input-underline w-full" tabindex="5" minlength="8" maxlength="150" wire:model.defer="old_password">
	                    <div class="reactive-label-input__show-btn reactive-label-input__show-btn--show">
	                        @svg('view-pwd-btn')
	                    </div>
	                    <div class="reactive-label-input__show-btn reactive-label-input__show-btn--hide" style="display: none;">
	                        @svg('hide-pwd-btn')
	                    </div>
	                </div>
                    @error('old_password') <span class="error primary-color">{{ $message }}</span> @enderror

	                <div class="input-group reactive-label-input w-full">
	                    <label style="color: black;">{{ __('dashboard.new-password-label') }}</label>
	                    <input type="password" name="new_password" class="input-underline w-full" tabindex="6" minlength="8" maxlength="150" wire:model.defer="new_password">
	                    <div class="reactive-label-input__show-btn reactive-label-input__show-btn--show">
	                        @svg('view-pwd-btn')
	                    </div>
	                    <div class="reactive-label-input__show-btn reactive-label-input__show-btn--hide" style="display: none;">
	                        @svg('hide-pwd-btn')
	                    </div>
	                </div>
                    @error('new_password') <span class="error primary-color">{{ $message }}</span> @enderror

	                <div class="input-group reactive-label-input w-full">
	                    <label style="color: black;">{{ __('dashboard.new-password-confirmation-label') }}</label>
	                    <input type="password" name="new_password_confirmation" class="input-underline w-full" tabindex="6" minlength="8" maxlength="150" wire:model.defer="new_password_confirmation">
	                    <div class="reactive-label-input__show-btn reactive-label-input__show-btn--show">
	                        @svg('view-pwd-btn')
	                    </div>
	                    <div class="reactive-label-input__show-btn reactive-label-input__show-btn--hide" style="display: none;">
	                        @svg('hide-pwd-btn')
	                    </div>
	                </div>
                    @error('new_password_confirmation') <span class="error primary-color">{{ $message }}</span> @enderror
                </div>

                <div class="w-full lg:w-5/12">
                	<h4>{{ __('dashboard.has-kulturpass') }}</h4>
                    <p class="font-medium mt-1 mb-2">
                        {{ __('dashboard.kulturpass-explanation') }}
                    </p>
                    <p class="font-bold mb-3">
                        <em>
                        @if($kulturpass_status == 0)
                            {{ __('dashboard.kulturpass-none') }}
                        @elseif($kulturpass_status ==  1)
                            {{ __('dashboard.kulturpass-validation_pending') }}
                        @else
                            {{ __('dashboard.kulturpass-valid') }}
                        @endif
                        </em>
                    </p>
                	<div>
                		<p class="mb-2">{{ __('dashboard.kulturpass-request-new') }}</p>
                        <input type="file" name="new_kulturpass" wire:model="new_kulturpass">
                        <p class="mb-10">
                            <em>{{ __('forms.kulturpass-accepted-formats') }}: .pdf, .jpg, .jpeg, .png, .bmp, .doc, .docx - {{ __('forms.kulturpass-max-size') }}: 6Mo</em>
                        </p>
                	</div>
                </div>
            </div>

            @if($show_confirmation == 1)
            <div class="mt-10 contact__form__valid">
            	{!! __('dashboard.details-update-confirm') !!}
            </div>
            @else
            <div class="mt-10 text-center">
            	<button class="btn-couture-plain" style="padding-bottom: 7px; padding-top: 7px; height: fit-content;">{{ __('dashboard.details-save-changes') }}</button>
            </div>
			@endif
		</form>
	</div>
</div>