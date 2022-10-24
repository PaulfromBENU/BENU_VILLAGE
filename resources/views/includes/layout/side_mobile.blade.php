<div id="side-mobile" class="side-mobile mobile-only benu-container">
    <div class="flex justify-around flex-wrap">
        <div id="mobile-general-menu-toggle" class="side-mobile__toggler side-mobile__toggler--general">
            {{ __('welcome.mobile-menu-btn-menu') }}
            <!-- Menu -->
        </div>
        <div id="mobile-creations-menu-toggle" class="side-mobile__toggler side-mobile__toggler--creation flex justify-center">
            @svg('benu-icon-squares-categories', 'side-mobile__toggler__svg')
            <p class="uppercase">
                {{ __('welcome.mobile-menu-btn-creations') }}
                <!-- Creations -->
            </p>
        </div>
    </div>
    <ul class="side-mobile__links mt-4" id="side-mobile-general-links">
        <li>
            <!-- onclick="document.getElementById('host-anchor').scrollIntoView({ behavior: 'smooth', block: 'center' });" -->
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="side-mobile-link">
                {!! __('welcome.side-menu-home') !!}
            </a>
        </li>
        <li>
            <a href="{{ route('news-'.app()->getLocale()) }}" class="side-mobile-link uppercase">
                <strong>{!! __('welcome.side-menu-news') !!}</strong>
            </a>
        </li>
        <li>
            <a href="{{ route('about-'.app()->getLocale()) }}" class="side-mobile-link uppercase">
                <strong>{!! __('welcome.side-menu-about') !!}</strong>
            </a>
        </li>
        <li>
            <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-shops')]) }}" class="side-mobile-link uppercase">
                <strong>{!! __('welcome.side-menu-shops') !!}</strong>
            </a>
        </li>
        <li>
            <a href="{{ route('client-service-'.app()->getLocale(), ['page' => __('slugs.services-faq')]) }}" class="side-mobile-link">
                {!! __('welcome.side-menu-client-service') !!}
            </a>
        </li>
        <li>
            <a href="{{ route('full-story-'.app()->getLocale()) }}" class="side-mobile-link">
                {!! __('welcome.side-menu-client-history') !!}
            </a>
        </li>
        <!-- <li>
            <a href="{{ route('partners-'.app()->getLocale()) }}" class="side-mobile-link">
                {!! __('welcome.side-menu-client-partners') !!}
            </a>
        </li> -->
        <li>
            <a href="{{ route('header.participate-'.app()->getLocale()) }}" class="side-mobile-link">
                {!! __('welcome.side-menu-client-participate') !!}
            </a>
        </li>
        <li>
            <a href="{{ route('vouchers-'.app()->getLocale()) }}" class="side-mobile-link">
                {!! __('welcome.side-menu-client-vouchers') !!}
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

    @livewire('header.creations-menu-mobile')

    <div class="flex justify-start pt-5">
        <a href="https://www.facebook.com/benuvillageesch/" target="_blank" rel="noreferrer" class="footer__social"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/benu_village/" target="_blank" rel="noreferrer" class="footer__social"><i class="fab fa-linkedin-in"></i></a>
        <a href="https://lu.linkedin.com/company/benu-village-esch" target="_blank" rel="noreferrer" class="footer__social"><i class="fab fa-instagram"></i></a>
    </div>
</div>