<div class="modal lang-modal" id="lang-modal" style="display: none;">
    <p class="lang-modal__title">
        {{ __('welcome.language-select') }}
    </p>
    <div class="flex justify-between">
        <a href="{{ route($route_name_de, $route_parameters_de) }}" class="lang-modal__block">
            <button class="lang-modal__block__btn">
                DE
            </button>
            <p class="text-center">
                Deutsch
            </p>
        </a>
        <a href="{{ route($route_name_en, $route_parameters_en) }}" class="lang-modal__block">
            <button class="lang-modal__block__btn">
                EN
            </button>
            <p class="text-center">
                English
            </p>
        </a>
        <a href="{{ route($route_name_fr, $route_parameters_fr) }}" class="lang-modal__block">
            <button class="lang-modal__block__btn">
                FR
            </button>
            <p class="text-center">
                Français
            </p>
        </a>
        <a href="{{ route($route_name_lu, $route_parameters_lu) }}" class="lang-modal__block">
            <button class="lang-modal__block__btn">
                LU
            </button>
            <p class="text-center">
                Lëtzebuergesch
            </p>
        </a>
    </div>
</div>