<x-filament::page>
	@foreach($unread_messages->groupBy('thread') as $thread => $messages)
		<div wire:key="{{ $thread }}" class="message-reply" style="padding-bottom: 30px;">
			<div class="message-reply__close">
				<button wire:click="closeThread({{ $thread }})">Close thread</button>
			</div>
			<h3>
				Messages by {{ $messages->first()['first_name'] }} {{ $messages->first()['last_name'] }} ({{ $messages->first()->email }})
			</h3>
			<h4>
				{{ $messages->count() }} @if($messages->count() <= 1) message @else messages @endif in thread
			</h4>

			<div class="pl-3">
				@foreach($messages as $message)
					<div wire:key="{{ $message['id'] }}">
						<p style="color: grey;">
							<em>Received on {{ $message->created_at->format('d\/m\/Y') }}, at {{ $message->created_at->format('H\hi') }}</em>
						</p>
						<p class="pl-2" style="margin-bottom: 10px;">
							{{ $message['message'] }}
						</p>
						@if($message->benuAnswers()->count() > 0)
							@foreach($message->benuAnswers()->orderBy('created_at', 'asc')->get() as $benu_answer)
								<div wire:key="{{ $benu_answer->id }}" class="message-reply__benu-reply">
									<h5>Reply by BENU, on {{ $benu_answer->created_at->format('d\/m\/Y') }}</h5>
									<p>
										<em>
											{{ $benu_answer->message }}
										</em>
									</p>
								</div>
							@endforeach
						@endif
					</div>
				@endforeach

				@if(App\Models\User::where('email', $messages->first()->email)->where('role', '<>', 'newsletter')->where('role', '<>', 'guest_client')->count() > 0)
				<h5>Add a reply:</h5>
				<form method="POST" wire:submit.prevent="sendReply({{ $thread }})">
					@csrf
					<textarea minlength="1" maxlength="2000" rows="4" class="w-full" required wire:model.defer="benu_answer.{{ $thread }}"></textarea>
					<div class="w-full text-center">
						<button>
							Send reply
						</button>
					</div>
				</form>
				@else 
				<h5>This user does not have an account. Please reply manually by sending an e-mail directly to this address: <a class="hover:underline" href="mailto:{{ $messages->first()->email }}">{{ $messages->first()->email }}</a> </h5>
				@endif
			</div>
		</div>
	@endforeach
	@if($unread_messages->count() == 0)
		<p>
			<em>No message for the moment...</em>
		</p>
	@endif
</x-filament::page>
