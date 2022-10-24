@extends('layouts.base_layout')

@section('title')
    {{ __('dashboard.seo-title') }}
@endsection

@section('description')
    {{ __('dashboard.seo-description') }}
@endsection

@section('robots-behaviour')
    noindex, nofollow
@endsection

@section('breadcrumbs')
    <div class="breadcrumbs pattern-bg">
        <div class="benu-container breadcrumbs__content flex justify-start">
            <a href="{{ route('home', [app()->getLocale()]) }}">{{ __('breadcrumbs.home') }}</a>
            <div class="pl-5 pr-5">
                >
            </div>
            <a href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}" class="primary-color"><strong>{{ __('breadcrumbs.my-account') }}</strong></a>
        </div>
    </div>
@endsection

@section('main-content')
    @livewire('dashboard.dashboard-navigation', ['section' => $section])
@endsection

@section('scripts')
<script type="text/javascript">
    function hideAddressModal()
    {
        $('.add-address-modal-container').fadeOut('fast');
        $('#modal-opacifier').fadeOut('fast');
    }

    $(function() {
        Livewire.on('showAddressModal', function() {
            $('.add-address-modal-container').fadeIn();
            $('#modal-opacifier').fadeIn('fast');

            $('.add-address-modal__close-btn').on('click', function() {
                hideAddressModal()
            })

            $(document).on('keyup',function(e) {
                if (e.keyCode == 27) {
                   hideAddressModal();
                }
            });
        });

        Livewire.on('sectionUpdated', function() {
            window.scrollTo(0, 0);
        });

        Livewire.on('orderSelected', function() {
            window.scrollTo(0, 0);
        });
    })
</script>
@endsection