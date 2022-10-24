<div class="dashboard-communications w-full">
    <h2>
        {!! __('dashboard.my-communications') !!}
    </h2>

    <ul class="faq__accordion">
        @foreach($contact_messages->groupBy('thread')->all() as $thread => $thread_messages)
        <li wire:key="{{ $thread }}">
            <div class="faq__accordion__header flex justify-between" @if($thread_messages->first()->closed == '1') style="background: grey;" @endif>
                <p class="w-5/6">
                    @if(in_array($thread, $unread_threads))
                    <i class="fas fa-star pr-2"></i>
                    @endif
                    @if($thread_messages->sortBy('created_at')->first()->origin == 'return')
                        {!! __('dashboard.com-return-received-on') !!} {{ $thread_messages->sortBy('created_at')->first()->created_at->format('d\/m\/Y') }}
                    @else
                        {!! __('dashboard.com-message-from') !!} {{ auth()->user()->first_name }} - {!! __('dashboard.com-sent-on') !!} {{ $thread_messages->first()->created_at->format('d\/m\/Y') }}
                    @endif
                    @if($thread_messages->first()->closed == '1')
                    <em> - {!! __('dashboard.com-thread-closed') !!}</em>
                    @endif
                </p>
                <p class="flex flex-col justify-center w-1/6 relative">
                    <img src="{{ asset('media/pictures/chevron_bottom_white.png') }}" class="faq__accordion__header__chevron">
                </p>
            </div>

            <div class="faq__accordion__answer pb-10" @if(!isset($showForm[$thread]) || $showForm[$thread] == 0) style="display: none;" @endif>
                @foreach($thread_messages->sortBy('created_at') as $message)
                    <div wire:key="{{ $message->id }}">
                        <p class="faq__accordion__answer__txt">
                            <span style="color: gray; padding-right: 10px;"><em>[{{ $message->created_at->format('d\/m\/Y\,\ H\hi') }}]</em></span> <br/> {{ $message->message }}
                        </p>
                        @if($message->benuAnswers()->count() > 0)
                            <ul class="mb-10">
                                @foreach($message->benuAnswers()->get() as $benu_answer)
                                <li wire:key="{{ $benu_answer->id }}">
                                    <div class="flex justify-between faq__accordion__answer__header">
                                        <p>{!! __('dashboard.com-answer-by-benu-sent-on') !!} {{ $benu_answer->created_at->format('d\/m\/Y') }}</p>
                                        <div class="flex flex-col justify-center">
                                            <p class="faq__accordion__answer__header__plus">+</p>
                                            <p class="faq__accordion__answer__header__minus" style="display: none;">-</p>
                                        </div>
                                    </div>
                                    <p class="faq__accordion__answer__subanswer" style="display: none;">
                                        {{ $benu_answer->message }}
                                    </p>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            @if($thread_messages->first()->closed == '0')
                @if(isset($showForm[$thread]) && $showForm[$thread] == 1)
                    <form method="POST" wire:submit.prevent="sendNewMessage({{ $thread }})">
                        @csrf
                        <!-- <input type="hidden" name="thread" value="{{ $thread }}" wire:model="message_thread.{{ $thread }}"> -->
                        <textarea name="message-{{ $thread }}" minlength="1" maxlength="2000" rows="5" class="w-full" wire:model="message.{{ $thread }}" required></textarea>
                        <button type="submit" class="mt-5 btn-couture-plain" style="height: fit-content;">{!! __('dashboard.com-send-message') !!}</button>
                    </form>
                @else
                    <div class="flex justify-start flex-wrap mt-8">
                        <button class="btn-couture-plain" style="height:fit-content; padding-top: 8px; padding-bottom: 8px;" wire:click="showMessageForm({{ $thread }})">{!! __('dashboard.com-wish-reply') !!}</button>
                        <button class="btn-couture-plain" style="height:fit-content; padding-top: 8px; padding-bottom: 8px;" wire:click="closeThread({{ $thread }})">{!! __('dashboard.com-wish-close') !!}</button>
                    </div>
                @endif
            @endif
            </div>
        </li>
        @endforeach
    </ul>


    @if($mask_requests->count() > 0)
    <ul class="faq__accordion">
        <li>
            <div class="faq__accordion__header flex justify-between">
                <p>
                    {!! __('dashboard.com-mask-demands-from') !!} {{ auth()->user()->first_name }}
                </p>
                <p><img src="{{ asset('media/pictures/chevron_bottom_white.png') }}" class="faq__accordion__header__chevron"></p>
            </div>

            <div class="faq__accordion__answer pb-10" style="display: none;">
                @foreach($mask_requests as $mask_request)
                    <h3 class="text-lg mb-2 font-bold">{!! __('dashboard.com-mask-demand-sent-on') !!} {{ $mask_request->created_at->format('d\/m\/Y') }}</h3>
                    <div wire:key="{{ $mask_request->id }}" class="flex justify-start pl-3 mb-5">
                        <div class="w-1/3">
                            <p class="faq__accordion__answer__txt">
                                <strong>{!! __('dashboard.com-creation') !!} : {{ $mask_request->creation->name }}</strong>
                            </p>
                            <p>
                                <em>{!! __('dashboard.com-requested-number') !!} : {{ $mask_request->requested_number }}</em>
                            </p>
                            <p class="mt-3">
                                <strong>{!! __('dashboard.com-options') !!} :</strong>
                            </p>
                            <ul>
                                @if(0 == 1 && $mask_request->creation->product_type == 2)
                                    <!-- Not required anymore -->
                                    <li><em>
                                        @if($mask_request->with_filter == 0)
                                            {!! __('dashboard.com-with-filter') !!}
                                        @else
                                            {!! __('dashboard.com-without-filter') !!}
                                        @endif
                                    </em></li>
                                    <li><em>
                                        @if($mask_request->with_cotton == 0)
                                            {!! __('dashboard.com-elastic-cords') !!}
                                        @else
                                            {!! __('dashboard.com-cotton-cords') !!}
                                        @endif
                                    </em></li>
                                @endif
                                @if($mask_request->creation->product_type == 1)
                                <li><em>
                                    @if($mask_request->size == 'small')
                                        {!! __('dashboard.com-mask-small-size') !!}
                                    @else
                                        {!! __('dashboard.com-mask-large-size') !!}
                                    @endif
                                </em></li>
                                @endif
                                <li><em>
                                    @if($mask_request->with_pictures == 1)
                                        {!! __('dashboard.com-with-pictures') !!}
                                    @else
                                        {!! __('dashboard.com-without-pictures') !!}
                                    @endif
                                </em></li>
                            </ul>
                        </div>
                        <div class="w-2/3 pl-5">
                            <h3 class="pb-3"><strong>{!! __('dashboard.com-your-request') !!} :</strong></h3>
                            <p class="pl-3">
                                <em>{{ $mask_request->text_demand }}</em>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </li>
    </ul>
    @endif

    @if($item_requests->count() > 0)
    <ul class="faq__accordion">
        <li>
            <div class="faq__accordion__header flex justify-between">
                <p>
                    {!! __('dashboard.com-item-demands-from') !!} {{ auth()->user()->first_name }}
                </p>
                <p><img src="{{ asset('media/pictures/chevron_bottom_white.png') }}" class="faq__accordion__header__chevron"></p>
            </div>

            <div class="faq__accordion__answer pb-10" style="display: none;">
                @foreach($item_requests as $item_request)
                    <h3 class="text-lg mb-2 font-bold">{!! __('dashboard.com-mask-demand-sent-on') !!} {{ $item_request->created_at->format('d\/m\/Y') }}</h3>
                    <div wire:key="{{ $item_request->id }}" class="flex justify-start pl-3">
                        <div class="w-1/3">
                            <p class="faq__accordion__answer__txt">
                                <strong>{!! __('dashboard.com-creation') !!} : {{ $item_request->creation->name }}</strong>
                            </p>
                            <p>
                                <em>{!! __('dashboard.com-requested-number') !!} : {{ $item_request->requested_number }}</em>
                            </p>
                            <p class="mt-3">
                                <strong>{!! __('dashboard.com-options') !!} :</strong>
                            </p>
                            <ul>
                                <li><em>
                                    @if($item_request->with_pictures == 1)
                                        {!! __('dashboard.com-with-pictures') !!}
                                    @else
                                        {!! __('dashboard.com-without-pictures') !!}
                                    @endif
                                </em></li>
                            </ul>
                        </div>
                        <div class="w-2/3 pl-5">
                            <h3 class="pb-3"><strong>{!! __('dashboard.com-your-request') !!} :</strong></h3>
                            <p class="pl-3">
                                <em>{{ $item_request->text_demand }}</em>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </li>
    </ul>
    @endif
</div>