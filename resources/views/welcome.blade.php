@extends('layouts.base_layout')

@section('title')
    {{ __('welcome.seo-title') }}
@endsection

@section('description')
    {{ __('welcome.seo-description') }}
@endsection

@section('main-content')
    @include('includes.welcome.presentation')
@endsection

@section('scripts')
<script type="text/javascript">
    $(function() {
        let bulletText = $('#welcome-bullet-presentation').text();
        let splitText = bulletText.split("•");
        let newText = "";
        let newSentence;
        splitText.forEach(function(sentence, index) {
            if (index > 0 && index) {
                // newSentence = "• " + sentence + '</li><li>';
                if (index == splitText.length - 1) {
                    newSentence = " " + sentence;
                } else {
                    newSentence = " " + sentence + '</li><li>';
                }

                newText += newSentence;
            }
        });
        $('#welcome-bullet-presentation').html('<li>' + newText + '</li>');
    });
</script>
@endsection
