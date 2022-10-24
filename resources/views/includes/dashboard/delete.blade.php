<div class="dashboard-delete">
	<h2>{{ __('dashboard.delete-account') }}</h2>
	<div>
		<h3>
			{{ __('dashboard.wish-delete-account') }}
		</h3>
		<p>
			{{ __('dashboard.delete-account-txt-1') }}
		</p>

		<form method="POST" wire:submit.prevent="deleteUser" class="mt-10">
			@csrf
			<div>
				<input type="checkbox" name="delete_confirm" wire:model.defer="delete_confirm" id="delete-confirm" required>
				<label for="delete-confirm" class="pl-2">{!! __('dashboard.confirm-delete-label') !!}</label>
			</div>
			<textarea wire:model.defer="delete_feedback" maxlength="1000" rows="3" class="w-full mt-10" placeholder="{{ __('dashboard.delete-more-info') }}"></textarea>

			@if($confirm_delete == 0)
			<div class="mt-10">
				<button class="btn-couture-plain btn-couture-plain--fit" wire:click.prevent="confirmDelete(1)" style="width: fit-content;">
					{{ __('dashboard.delete-request-confirm') }}
				</button>
			</div>
			@else
			<p class="mt-10 mb-2 pl-3">
				<strong>{{ __('dashboard.delete-last-warning') }}</strong>
			</p>
			<div class="flex justify-start flex-wrap">
				<button type="submit" class="btn-couture-plain btn-couture-plain--fit block mr-5">
					{{ __('dashboard.delete-confirm-btn') }}
				</button>
				<div class="btn-couture-plain btn-couture-plain--grey btn-couture-plain--fit" wire:click="confirmDelete(0)">
					{{ __('dashboard.delete-cancel-btn') }}
				</div>
			</div>
			@endif
		</form>
	</div>
</div>