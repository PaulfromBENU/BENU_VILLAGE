<div class="modal connect-modal" id="connect-modal" style="display: none;">
	<p class="connect-modal__title">{{ __('auth.login-modal-title') }}</p>
	<form method="POST" action="{{ route('login.connect', [app()->getLocale()]) }}">
		@csrf
		<div class="flex justify-start w-full">
			<div class="reactive-label-input w-1/2"> <!-- connect-modal__input-group  -->
				<label for="header-login-email">{{ __('auth.login-email') }} *</label>
				<input type="text" name="email" class="input-underline w-5/6" id="header-login-email" required>
			</div>
			<div class="reactive-label-input w-1/2">
				<label for="header-login-pwd">{{ __('auth.login-password') }} *</label>
				<input type="password" name="password" class="input-underline w-5/6" id="header-login-pwd" required>
				<div class="flex items-center justify-start login__options absolute" style="bottom: -26px; left: 0;">
		            <a class="connect-modal__forgotten-pwd text-sm text-gray-800" href="{{ route('password.request-'.app()->getLocale()) }}">
		                {{ __('auth.login-pwd-forgotten') }}
		            </a>
		        </div>
			</div>
		</div>

		<!-- Remember Me -->
        <div class="connect-modal__checkbox">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                <span class="ml-2 text-sm text-gray-800">{{ __('auth.login-remember-me') }}</span>
            </label>
        </div>

		<div class="flex justify-start w-full">
			<div class="w-1/2"> <!-- connect-modal__input-group -->
				<a href="{{ route('register-'.app()->getLocale()) }}" class="btn-slider-left connect-modal__register">{{ __('auth.login-create-account') }}</a>
			</div>
			<div class="w-1/2"> <!-- connect-modal__input-group -->
				<button type="submit" class="btn-couture connect-modal__btn">{{ __('auth.login-connect') }}</button>
			</div>
		</div>
	</form>
</div>