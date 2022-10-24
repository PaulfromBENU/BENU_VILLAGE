<section class="flex justify-between flex-wrap lg:flex-nowrap model-pres benu-container">
	<div class="model-pres__img-container">
		@foreach($model_pictures as $picture)
            <img src="{{ asset('media/pictures/articles/'.$picture) }}" @if($loop->index > 0) style="display: none;" @endif>
        @endforeach
        @if($model_pictures->count() > 1)
            <div class="slider-arrow slider-arrow--color-2 slider-arrow--left article-arrow-left">
                <i class="fas fa-chevron-left"></i>
            </div>
            <div class="slider-arrow slider-arrow--color-2 slider-arrow--right article-arrow-right">
                <i class="fas fa-chevron-right"></i>
            </div>
        @endif
	</div>

	<div class="model-pres__mobile-anchors mobile-only flex flex-col md:flex-row justify-start md:justify-center">
		<a onclick='document.getElementById("model-articles").scrollIntoView({ behavior: "smooth", block: "start" });' class="flex justify-start md:justify-center">
			{{ __('models.model-link-articles') }} @svg('model_arrow_down')
		</a>
		
		@if($model->creation_accessories()->count() > 0)
		<a onclick='document.getElementById("model-extra-accessories").scrollIntoView({ behavior: "smooth", block: "center" });' class="flex justify-start md:justify-center model-pres__mobile-anchors--with-border">
			{{ __('models.model-link-accessories') }} @svg('model_arrow_down')
		</a>
		@endif
	</div>

	<div class="model-pres__desc">
		@if($model->name == 'PINNA')
		<!-- Case kid apron -->
			<div class="flex flex-col lg:flex-row justify-start">
				<h1 class="model-pres__desc__title">{{ strtoupper($model->name) }}</h1>
				<div class="model-pres__desc__age lg:ml-5 w-3/4 md:w-1/4 m-auto" style="min-width: fit-content;">
					{{ strtoupper(__('models.apron-kid-info')) }}
				</div>
			</div>
		@elseif($model->name == 'SCIMOR')
		<!-- Case teen apron -->
			<div class="flex flex-col lg:flex-row justify-start">
				<h1 class="model-pres__desc__title">{{ strtoupper($model->name) }}</h1>
				<div class="model-pres__desc__age lg:ml-5 w-3/4 md:w-1/4 m-auto" style="min-width: fit-content;">
					{{ strtoupper(__('models.apron-teen-info')) }}
				</div>
			</div>
		@elseif($model->name == 'SELACHI')
		<!-- Case adult apron -->
			<div class="flex flex-col lg:flex-row justify-start">
				<h1 class="model-pres__desc__title">{{ strtoupper($model->name) }}</h1>
				<div class="model-pres__desc__age lg:ml-5 w-3/4 md:w-1/4 m-auto" style="min-width: fit-content;">
					{{ strtoupper(__('models.apron-adult-info')) }}
				</div>
			</div>
		@elseif($model->product_type == 0)
			<h1 class="model-pres__desc__title">{{ __('models.model') }} {{ strtoupper($model->name) }}</h1>
		@elseif($model->product_type == 1)
		<!-- Case mask for kids -->
			<div class="flex flex-col lg:flex-row justify-start">
				<h1 class="model-pres__desc__title">{{ __('models.masks') }} {{ strtoupper($model->name) }}</h1>
				<div class="model-pres__desc__age lg:ml-5 w-3/4 md:w-1/4 m-auto">
					{{ strtoupper(__('models.masks-kid')) }}
				</div>
			</div>
		@elseif($model->product_type == 2)
		<!-- Case mask for adults -->
			<div class="flex flex-col lg:flex-row justify-start">
				<h1 class="model-pres__desc__title">{{ __('models.masks') }} {{ strtoupper($model->name) }}</h1>
				<div class="model-pres__desc__age lg:ml-5 w-3/4 md:w-1/4 m-auto" style="min-width: fit-content;">
					{{ strtoupper(__('models.masks-adult')) }}
				</div>
			</div>
		@elseif($model->product_type == 3)
		<!-- Case small item -->
			<div class="flex flex-col lg:flex-row justify-start">
				<h1 class="model-pres__desc__title">{{ strtoupper($model->name) }}</h1>
				<div class="model-pres__desc__age lg:ml-5 w-3/4 md:w-1/4 m-auto" style="min-width: fit-content;">
					{{ strtoupper(__('models.is-small-item')) }}
				</div>
			</div>
		@else
		<!-- All other cases -->
			<h1 class="model-pres__desc__title">{{ __('models.model') }} {{ strtoupper($model->name) }}</h1>
		@endif
		
		<p class="model-pres__desc__txt">
			{{ $localized_description }}
		</p>
		<div class="flex flex-col md:flex-row justify-start model-pres__desc__keywords">
			<ul class="w-full lg:w-1/2">
				@for($i = 0; $i < 4; $i++)
					@if(isset($keywords[$i]))
					<li class="flex">@svg('list_cintre', 'w-1/5') <p class="w-4/5">{{ $keywords[$i] }}</p></li>
					@endif
				@endfor
			</ul>
			
			@if(sizeof($keywords) > 4)
			<ul class="w-full lg:w-1/2">
				@for($i = 4; $i < 8; $i++)
					@if(isset($keywords[$i]))
					<li class="flex">@svg('list_cintre', 'w-1/5') <p class="w-4/5">{{ $keywords[$i] }}</p></li>
					@endif
				@endfor
			</ul>
			@endif
		</div>

		@if($model->product_type == 1 || $model->product_type == 2)
		<div class="model-pres__desc__link">
			<button id="mask-specific-order-btn" class="btn-couture-plain btn-couture-plain--dark-hover mb-5" style="">
				{{ __('models.model-specific-order-btn') }}
			</button>
		</div>
		@elseif($model->product_type == 3)
		<div class="model-pres__desc__link">
			<button id="items-specific-order-btn" class="btn-couture-plain btn-couture-plain--dark-hover mb-5" style="">
				{{ __('models.items-specific-order-btn') }}
			</button>
		</div>
		@endif

		
		<div class="model-pres__desc__seemore">
			<div class="model-pres__wiki-link">
				<p class="model-pres__desc__txt" style="margin-bottom: 20px;">
					{!! __('models.link-explanation') !!}
				</p>
				<p class="model-pres__desc__link">
					@php $link_query = "origin_link_".app()->getLocale(); @endphp
					<a href="{{ $model->$link_query }}" target="_blank" class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" style="margin: 0;">{{ __('models.model-origins') }} {{ strtoupper($model->name) }}</a>
				</p>
			</div>

			@if($model->product_type != 3)
			<div class="flex tablet-hidden">
				<a onclick='document.getElementById("model-articles").scrollIntoView({ behavior: "smooth", block: "start" });' class="flex">
					{{ __('models.model-link-articles') }} @svg('model_arrow_down')
				</a>
				
				@if($model->creation_accessories()->count() > 0)
				<a onclick='document.getElementById("model-extra-accessories").scrollIntoView({ behavior: "smooth", block: "center" });' class="flex">
					{{ __('models.model-link-accessories') }} @svg('model_arrow_down')
				</a>
				@endif
			</div>
			@endif
		</div>
	</div>
</section>