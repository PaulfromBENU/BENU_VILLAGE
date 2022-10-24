<a href="{{ $link }}" class="campaign-overview flex justify-start md:justify-between flex-wrap">
	<div class="campaign-overview__picture">
		<img src="{{ asset('media/pictures/campaigns/'.$picture) }}">
	</div>
	<div class="campaign-overview__summary">
		<h3>
			{{ $title }}
		</h3>
		<p class="campaign-overview__summary__date">
			{{ $date }}
		</p>
		<p class="campaign-overview__summary__desc">
			{{ $summary }}...
		</p>
	</div>
</a>