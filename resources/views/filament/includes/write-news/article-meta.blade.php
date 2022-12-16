<input type="hidden" name="article_id" wire:model="article_id">
	<h3>
		Title of the news
	</h3>
	<section class="flex justify-around create-news__title">
		<div class="create-news__title__input">
			<label>FR:</label><br/>
			<input type="text" name="article_title_fr" wire:model.defer="article_title_fr" placeholder="Title in French" required>
		</div>
		<div class="create-news__title__input">
			<label>LU:</label><br/>
			<input type="text" name="article_title_lu" wire:model.defer="article_title_lu" placeholder="Title in Luxemburgish" required>
		</div>
		<div class="create-news__title__input">
			<label>DE:</label><br/>
			<input type="text" name="article_title_de" wire:model.defer="article_title_de" placeholder="Title in German" required>
		</div>
		<div class="create-news__title__input">
			<label>EN:</label><br/>
			<input type="text" name="article_title_en" wire:model.defer="article_title_en" placeholder="Title in English" required>
		</div>
	</section>

	<h3>
		News slug (format-like-this-for-url) - Should be unique!
	</h3>
	<section class="flex justify-around create-news__title">
		<div class="create-news__title__input">
			<label>FR:</label><br/>
			<input type="text" name="article_slug_fr" wire:model.defer="article_slug_fr" placeholder="Slug in French" required>
		</div>
		<div class="create-news__title__input">
			<label>LU:</label><br/>
			<input type="text" name="article_slug_lu" wire:model.defer="article_slug_lu" placeholder="Slug in Luxemburgish" required>
		</div>
		<div class="create-news__title__input">
			<label>DE:</label><br/>
			<input type="text" name="article_slug_de" wire:model.defer="article_slug_de" placeholder="Slug in German" required>
		</div>
		<div class="create-news__title__input">
			<label>EN:</label><br/>
			<input type="text" name="article_slug_en" wire:model.defer="article_slug_en" placeholder="Slug in English" required>
		</div>
	</section>

	<h3>
		News tags
	</h3>
	<section>
		<div class="flex justify-around create-news__title">
			<div class="create-news__title__input">
				<label>Tag 1:</label><br/>
				<select wire:model="article_tag_1_en">
					<option value="" style="color: lightgrey;">Tag 1 (in English)</option>
					<option value="{{ ucfirst(strtolower(__('news.tag-events', [], 'en'))) }}">{{ ucfirst(strtolower(__('news.tag-events', [], 'en'))) }}</option>
					<option value="{{ ucfirst(strtolower(__('news.tag-what-s-new', [], 'en'))) }}">{{ ucfirst(strtolower(__('news.tag-what-s-new', [], 'en'))) }}</option>
					<option value="{{ ucfirst(strtolower(__('news.tag-environment', [], 'en'))) }}">{{ ucfirst(strtolower(__('news.tag-environment', [], 'en'))) }}</option>
				</select>
				<!-- <input type="text" name="article_tag_1_fr" wire:model.defer="article_tag_1_fr" placeholder="Tag 1 in French"> -->
			</div>
			<div class="create-news__title__input">
				<label>Tag 2:</label><br/>
				<select wire:model="article_tag_2_en">
					<option value="" style="color: lightgrey;">Tag 2 (in English)</option>
					<option value="{{ ucfirst(strtolower(__('news.tag-events', [], 'en'))) }}">{{ ucfirst(strtolower(__('news.tag-events', [], 'en'))) }}</option>
					<option value="{{ ucfirst(strtolower(__('news.tag-what-s-new', [], 'en'))) }}">{{ ucfirst(strtolower(__('news.tag-what-s-new', [], 'en'))) }}</option>
					<option value="{{ ucfirst(strtolower(__('news.tag-environment', [], 'en'))) }}">{{ ucfirst(strtolower(__('news.tag-environment', [], 'en'))) }}</option>
				</select>
			</div>
			<!-- <div class="create-news__title__input">
				<label>Tag 3:</label><br/>
				<select wire:model="article_tag_3_en">
					<option value="" style="color: lightgrey;">Tag 3 (in English)</option>
					<option value="{{ ucfirst(strtolower(__('news.tag-events', [], 'en'))) }}">{{ ucfirst(strtolower(__('news.tag-events', [], 'en'))) }}</option>
					<option value="{{ ucfirst(strtolower(__('news.tag-what-s-new', [], 'en'))) }}">{{ ucfirst(strtolower(__('news.tag-what-s-new', [], 'en'))) }}</option>
					<option value="{{ ucfirst(strtolower(__('news.tag-environment', [], 'en'))) }}">{{ ucfirst(strtolower(__('news.tag-environment', [], 'en'))) }}</option>
				</select>
			</div> -->
		</div>
	</section>

	<h3>
		News summary (displayed in all news list)
	</h3>
	<section class="flex justify-around create-news__title">
		<div class="create-news__title__input">
			<label>FR:</label><br/>
			<textarea name="article_summary_fr" wire:model.defer="article_summary_fr" placeholder="Summary in French" maxlength="190" required></textarea> 
		</div>
		<div class="create-news__title__input">
			<label>LU:</label><br/>
			<textarea name="article_summary_lu" wire:model.defer="article_summary_lu" placeholder="Summary in Luxemburgish" maxlength="190" required></textarea> 
		</div>
		<div class="create-news__title__input">
			<label>DE:</label><br/>
			<textarea name="article_summary_de" wire:model.defer="article_summary_de" placeholder="Summary in German" maxlength="190" required></textarea> 
		</div>
		<div class="create-news__title__input">
			<label>EN:</label><br/>
			<textarea name="article_summary_en" wire:model.defer="article_summary_en" placeholder="Summary in English" maxlength="190" required></textarea> 
		</div>
	</section>

	<h3>
		News SEO title (title appearing in Google results)
	</h3>
	<section class="flex justify-around create-news__title">
		<div class="create-news__title__input">
			<label>FR:</label><br/>
			<input type="text" name="article_seo_title_fr" wire:model.defer="article_seo_title_fr" placeholder="SEO title in French" maxlength="70" required>
		</div>
		<div class="create-news__title__input">
			<label>LU:</label><br/>
			<input type="text" name="article_seo_title_lu" wire:model.defer="article_seo_title_lu" placeholder="SEO title in Luxemburgish" maxlength="70" required>
		</div>
		<div class="create-news__title__input">
			<label>DE:</label><br/>
			<input type="text" name="article_seo_title_de" wire:model.defer="article_seo_title_de" placeholder="SEO title in German" maxlength="70" required>
		</div>
		<div class="create-news__title__input">
			<label>EN:</label><br/>
			<input type="text" name="article_seo_title_en" wire:model.defer="article_seo_title_en" placeholder="SEO title in English" maxlength="70" required>
		</div>
	</section>

	<h3>
		News SEO description (description appearing in Google results)
	</h3>
	<section class="flex justify-around create-news__title">
		<div class="create-news__title__input">
			<label>FR:</label><br/>
			<textarea name="article_seo_desc_fr" wire:model.defer="article_seo_desc_fr" placeholder="SEO desc in French" required></textarea> 
		</div>
		<div class="create-news__title__input">
			<label>LU:</label><br/>
			<textarea name="article_seo_desc_lu" wire:model.defer="article_seo_desc_lu" placeholder="SEO desc in Luxemburgish" required></textarea> 
		</div>
		<div class="create-news__title__input">
			<label>DE:</label><br/>
			<textarea name="article_seo_desc_de" wire:model.defer="article_seo_desc_de" placeholder="SEO desc in German" required></textarea> 
		</div>
		<div class="create-news__title__input">
			<label>EN:</label><br/>
			<textarea name="article_seo_desc_en" wire:model.defer="article_seo_desc_en" placeholder="SEO desc in English" required></textarea> 
		</div>
	</section>

	<h3>News main photo</h3>
	<input type="file" wire:model="main_photo" class="new-photo-form__file-input">
    <div wire:loading wire:target="main_photo">Uploading...</div>

    @error('main_photo') <span class="error">{{ $message }}</span> @enderror
    @if(is_string($main_photo) && $main_photo !== "")
    	<h4>Photo Preview:</h4>
        <div class="flex justify-start new-photo-form__img-gallery">
	        <div class="new-photo-form__img-gallery__img-container">
	        	<img src="{{ asset('images/pictures/news/'.$main_photo) }}">
	        </div>
	    </div>
    @elseif($main_photo !== null && $main_photo->temporaryUrl() !== null)
        <h4>Photo Preview:</h4>
        <div class="flex justify-start new-photo-form__img-gallery">
	        <div class="new-photo-form__img-gallery__img-container">
	        	<img src="{{ $main_photo->temporaryUrl() }}">
	        </div>
	    </div>
    @endif