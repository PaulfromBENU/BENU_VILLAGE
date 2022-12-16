<div id="side-mobile" class="side-mobile mobile-only benu-container">
    <div class="flex justify-around flex-wrap">
        <!-- <div id="mobile-general-menu-toggle" class="side-mobile__toggler side-mobile__toggler--general">
            {{ __('welcome.mobile-menu-btn-menu') }}
        </div> -->
    </div>
    <ul class="side-mobile__links mt-4" id="side-mobile-general-links">
        <li>
            <!-- onclick="document.getElementById('host-anchor').scrollIntoView({ behavior: 'smooth', block: 'center' });" -->
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="side-mobile-link">
                {!! __('welcome.side-menu-home') !!}
            </a>
        </li>
        <li>
            <a href="{{ route('news-all-'.app()->getLocale()) }}" class="side-mobile-link uppercase">
                <strong>{!! __('welcome.side-menu-news') !!}</strong>
            </a>
        </li>
        <li>
            <a href="{{ route('about-'.app()->getLocale()) }}" class="side-mobile-link uppercase">
                <strong>{!! __('welcome.side-menu-about') !!}</strong>
            </a>
        </li>
        <li>
            <a href="{{ route('header.participate-'.app()->getLocale()) }}" class="side-mobile-link uppercase">
                <strong>{!! __('welcome.side-menu-client-participate') !!}</strong>
            </a>
        </li>
        <li>
            <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-contact')]) }}" class="side-mobile-link">
                {!! __('welcome.side-menu-client-contact') !!}
            </a>
        </li>
        <li>
            <a href="{{ route('newsletter-'.app()->getLocale()) }}" class="side-mobile-link">
                {!! __('welcome.side-menu-client-newsletter') !!}
            </a>
        </li>
    </ul>

    <div class="flex justify-start pt-5">
        <a href="https://www.facebook.com/benuvillageesch/" target="_blank" rel="noreferrer" class="footer__social"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/benu_village/" target="_blank" rel="noreferrer" class="footer__social"><i class="fab fa-linkedin-in"></i></a>
        <a href="https://lu.linkedin.com/company/benu-village-esch" target="_blank" rel="noreferrer" class="footer__social"><i class="fab fa-instagram"></i></a>
    </div>
</div>