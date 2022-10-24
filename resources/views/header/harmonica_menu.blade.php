<div class="harmonica-bar">
	<h4 class="harmonica-bar__title text-center">
		{{ __('header.universe') }}
	</h4>
</div>

<div class="harmonica-menu">
	<div class="harmonica-menu__content">
		<h4 class="harmonica-bar__title harmonica-bar__title--active text-center">
			{{ __('header.universe') }}
		</h4>
		<div class="text-center harmonica-bar__close">
			<button>&#x2715;</button>
		</div>
		<div class="flex flex-col lg:flex-row justify-center" style="height: 100%; overflow: hidden;">
			<div class="harmonica-menu__content__col harmonica-menu__content__col--village">
				<div class="harmonica-menu__content__col__closed harmonica-menu__content__col__closed--village">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_village', 'm-auto')
					</div>
					<div class="flex flex-col justify-center harmonica-menu__content__col__title">
						<h3 class="harmonica-menu__content__col__title--village">BENU VILLAGE ESCH ASBL</h3>
					</div>
				</div>
				<div class="harmonica-menu__content__col__open harmonica-menu__content__col__open--village">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_village_blanc', 'm-auto')
					</div>
					<div class="harmonica-menu__content__col__open__desc flex flex-col justify-center">
						<h4>BENU VILLAGE ESCH ASBL</h4>
						<div class="text-center harmonica-menu__content__col__open__desc__text">
							{!! __('header.village-desc') !!}
						</div>
						<div class="text-center harmonica-menu__content__col__open__desc__text--mobile">
							{!! __('header.village-desc') !!}
						</div>
						<div class="text-center">
							<a href="https://benu.lu" target="_blank" rel="noreferrer" class="btn-trans btn-trans--b-white btn-hover-village">
							{!! __('header.discover-village') !!}</a>
						</div>
					</div>
				</div>
			</div>

			<div class="harmonica-menu__content__col harmonica-menu__content__col--sis">
				<div class="harmonica-menu__content__col__closed harmonica-menu__content__col__closed--sis">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_sis', 'm-auto')
					</div>
					<div class="flex flex-col justify-center harmonica-menu__content__col__title">
						<h3 class="harmonica-menu__content__col__title--sis">BENU VILLAGE SIS</h3>
					</div>
				</div>
				<div class="harmonica-menu__content__col__open harmonica-menu__content__col__open--sis">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_sis_blanc', 'm-auto')
					</div>
					<div class="harmonica-menu__content__col__open__desc flex flex-col justify-center">
						<h4>BENU VILLAGE SIS</h4>
						<div class="text-center harmonica-menu__content__col__open__desc__text">
							{!! __('header.sis-desc') !!}
						</div>
						<div class="text-center harmonica-menu__content__col__open__desc__text--mobile">
							{!! __('header.sis-desc') !!}
						</div>
						<div class="text-center">
							<a href="https://benu.lu" target="_blank" rel="noreferrer" class="btn-trans btn-trans--b-white btn-hover-sis">{!! __('header.discover-sis') !!}</a>
						</div>
					</div>
				</div>
			</div>

			<div class="harmonica-menu__content__col harmonica-menu__content__col--sloow">
				<div class="harmonica-menu__content__col__closed harmonica-menu__content__col__closed--sloow">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_sloow', 'm-auto')
					</div>
					<div class="flex flex-col justify-center harmonica-menu__content__col__title">
						<h3 class="harmonica-menu__content__col__title--sloow">BENU SLOOW</h3>
					</div>
				</div>
				<div class="harmonica-menu__content__col__open harmonica-menu__content__col__open--sloow">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_sloow_blanc', 'm-auto')
					</div>
					<div class="harmonica-menu__content__col__open__desc flex flex-col justify-center">
						<h4>BENU SLOOW</h4>
						<div class="text-center harmonica-menu__content__col__open__desc__text">
							{!! __('header.sloow-desc') !!}
						</div>
						<div class="text-center harmonica-menu__content__col__open__desc__text--mobile">
							{!! __('header.sloow-desc') !!}
						</div>
						<div class="text-center">
							<a href="https://sloow.benu.lu" target="_blank" rel="noreferrer" class="btn-trans btn-trans--b-white btn-hover-sloow">{!! __('header.discover-sloow') !!}</a>
						</div>
					</div>
				</div>
			</div>

			<div class="harmonica-menu__content__col harmonica-menu__content__couture">
				<div class="harmonica-menu__content__col__closed harmonica-menu__content__col__closed--couture">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_couture', 'm-auto')
					</div>
					<div class="flex flex-col justify-center harmonica-menu__content__col__title">
						<h3 class="harmonica-menu__content__col__title--couture">BENU COUTURE</h3>
					</div>
				</div>
				<div class="harmonica-menu__content__col__open harmonica-menu__content__col__open--couture">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_couture_blanc', 'm-auto')
					</div>
					<div class="harmonica-menu__content__col__open__desc flex flex-col justify-center">
						<h4>BENU COUTURE</h4>
						<div class="text-center harmonica-menu__content__col__open__desc__text">
							{!! __('header.couture-desc') !!}
						</div>
						<div class="text-center harmonica-menu__content__col__open__desc__text--mobile">
							{!! __('header.couture-desc') !!}
						</div>
						<div class="text-center">
							<a href="https://couture.benu.lu" target="_blank" rel="noreferrer" class="btn-trans btn-trans--b-white btn-hover-couture">{!! __('header.discover-couture') !!}</a>
						</div>
					</div>
				</div>
			</div>

			<div class="harmonica-menu__content__col harmonica-menu__content__reuse">
				<div class="harmonica-menu__content__col__closed harmonica-menu__content__col__closed--reuse">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_reuse', 'm-auto')
					</div>
					<div class="flex flex-col justify-center harmonica-menu__content__col__title">
						<h3 class="harmonica-menu__content__col__title--reuse">BENU REUSE</h3>
					</div>
				</div>
				<div class="harmonica-menu__content__col__open harmonica-menu__content__col__open--reuse">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_reuse_blanc', 'm-auto')
					</div>
					<div class="harmonica-menu__content__col__open__desc flex flex-col justify-center">
						<h4>BENU REUSE</h4>
						<div class="text-center harmonica-menu__content__col__open__desc__text">
							{!! __('header.reuse-desc') !!}
						</div>
						<div class="text-center harmonica-menu__content__col__open__desc__text--mobile">
							{!! __('header.reuse-desc') !!}
						</div>
						<div class="text-center">
							<a href="https://www.benureuse.lu" target="_blank" rel="noreferrer" class="btn-trans btn-trans--b-white btn-hover-reuse">{!! __('header.discover-reuse') !!}</a>
						</div>
					</div>
				</div>
			</div>

			<div class="harmonica-menu__content__col harmonica-menu__content__lasa">
				<div class="harmonica-menu__content__col__closed harmonica-menu__content__col__closed--lasa">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_lasa', 'm-auto')
					</div>
					<div class="flex flex-col justify-center harmonica-menu__content__col__title">
						<h3 class="harmonica-menu__content__col__title--lasa">BENU LaSA</h3>
					</div>
				</div>
				<div class="harmonica-menu__content__col__open harmonica-menu__content__col__open--lasa">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_lasa_blanc', 'm-auto')
					</div>
					<div class="harmonica-menu__content__col__open__desc flex flex-col justify-center">
						<h4>BENU LaSA</h4>
						<div class="text-center harmonica-menu__content__col__open__desc__text">
							{!! __('header.lasa-desc') !!}
						</div>
						<div class="text-center harmonica-menu__content__col__open__desc__text--mobile">
							{!! __('header.lasa-desc') !!}
						</div>
						<div class="text-center">
							<a href="https://benu.lu" target="_blank" rel="noreferrer" class="btn-trans btn-trans--b-white btn-hover-lasa">{!! __('header.discover-lasa') !!}</a>
						</div>
					</div>
				</div>
			</div>

			<div class="harmonica-menu__content__col harmonica-menu__content__design">
				<div class="harmonica-menu__content__col__closed harmonica-menu__content__col__closed--design">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_design', 'm-auto')
					</div>
					<div class="flex flex-col justify-center harmonica-menu__content__col__title">
						<h3 class="harmonica-menu__content__col__title--design">BENU FORM</h3>
					</div>
				</div>
				<div class="harmonica-menu__content__col__open harmonica-menu__content__col__open--design">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_design_blanc', 'm-auto')
					</div>
					<div class="harmonica-menu__content__col__open__desc flex flex-col justify-center">
						<h4>BENU FORM</h4>
						<div class="text-center harmonica-menu__content__col__open__desc__text">
							{!! __('header.design-desc') !!}
						</div>
						<div class="text-center harmonica-menu__content__col__open__desc__text--mobile">
							{!! __('header.design-desc') !!}
						</div>
						<div class="text-center">
							<a href="https://benu.lu" target="_blank" rel="noreferrer" class="btn-trans btn-trans--b-white btn-hover-design">{!! __('header.discover-design') !!}</a>
						</div>
					</div>
				</div>
			</div>

			<div class="harmonica-menu__content__col harmonica-menu__content__col--break">
				<div class="harmonica-menu__content__col__closed harmonica-menu__content__col__closed--break">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_break', 'm-auto')
					</div>
					<div class="flex flex-col justify-center harmonica-menu__content__col__title">
						<h3 class="harmonica-menu__content__col__title--break">BENU BREAK</h3>
					</div>
				</div>
				<div class="harmonica-menu__content__col__open harmonica-menu__content__col__open--break">
					<div class="harmonica-menu__content__col__banner">
						@svg('logo_benu_break_blanc', 'm-auto')
					</div>
					<div class="harmonica-menu__content__col__open__desc flex flex-col justify-center">
						<h4>BENU BREAK</h4>
						<div class="text-center harmonica-menu__content__col__open__desc__text">
							{!! __('header.break-desc') !!}
						</div>
						<div class="text-center harmonica-menu__content__col__open__desc__text--mobile">
							{!! __('header.break-desc') !!}
						</div>
						<div class="text-center">
							<a href="https://benu.lu" target="_blank" rel="noreferrer" class="btn-trans btn-trans--b-white btn-hover-break">{!! __('header.discover-break') !!}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>