<x-filament::page>
	<section class="newsletter-handle">
		<div class="newsletter-handle__title">
			<h2>
				Users waiting for newsletter confirmation<span wire:loading> - processing...</span>
			</h2>
			<p>
				<em>Add user to MailChimp, then validate. User will then automatically receive a confirmation e-mail.</em>
			</p>
		</div>

		@foreach($pending_users as $pending_user)
		<div class="newsletter-handle__pending-user flex justify-between" wire:key="pending-{{ $pending_user->id }}">
			<div class="flex newsletter-handle__pending-user__info">
				<p>
					{{ ucfirst($pending_user->first_name) }} {{ ucfirst($pending_user->last_name) }} - 
				</p>
				<p class="flex newsletter-handle__pending-user__info--email">
					{{ $pending_user->email }}
				</p>
			</div>
			<div class="flex">
				<button wire:click="validateNewsletter({{ $pending_user->id }})">Validate subscription</button>
				<button wire:click="cancelNewsletter({{ $pending_user->id }})">Cancel subscription</button>
			</div>
		</div>
		@endforeach


		<div class="newsletter-handle__title" style="margin-top: 60px;">
			<h2>
				Users waiting for newsletter cancellation<span wire:loading> - processing...</span>
			</h2>
			<p>
				<em>Remove user from MailChimp, then validate. User will then automatically receive a confirmation e-mail.</em>
			</p>
		</div>

		@foreach($cancelling_users as $cancelling_user)
		<div class="newsletter-handle__pending-user flex justify-between" wire:key="cancelling-{{ $cancelling_user->id }}">
			<div class="flex newsletter-handle__pending-user__info">
				<p>
					{{ ucfirst($cancelling_user->first_name) }} {{ ucfirst($cancelling_user->last_name) }} - 
				</p>
				<p class="flex newsletter-handle__pending-user__info--email">
					{{ $cancelling_user->email }}
				</p>
			</div>
			<div class="flex">
				<button wire:click="cancelNewsletterWithConfirmation({{ $cancelling_user->id }})">Validate cancellation</button>
				<button wire:click="maintainNewsletter({{ $cancelling_user->id }})">Ignore cancellation</button>
			</div>
		</div>
		@endforeach


		<div class="newsletter-handle__title" style="margin-top: 60px;">
			<h2>
				Users currently subscribed <span wire:loading> - processing...</span>
			</h2>
			<p>
				<em>To remove a user from the newsletter list, remove from MailChimp list, then remove with the button below. Upon removal, the user will be completely deleted if he/she is only registered as a newsletter subscriber in the database. The user will not be notified.</em>
			</p>
		</div>

		@foreach($subscribed_users as $subscribed_user)
		<div class="newsletter-handle__pending-user flex justify-between" wire:key="subscribed-{{ $subscribed_user->id }}">
			<div class="flex newsletter-handle__pending-user__info">
				<p>
					{{ ucfirst($subscribed_user->first_name) }} {{ ucfirst($subscribed_user->last_name) }} - 
				</p>
				<p class="flex newsletter-handle__pending-user__info--email">
					{{ $subscribed_user->email }}
				</p>
			</div>
			<div class="flex">
				<button wire:click="cancelNewsletter({{ $subscribed_user->id }})">Cancel subscription</button>
			</div>
		</div>
		@endforeach
	</section>
</x-filament::page>
