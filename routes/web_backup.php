<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

use App\Models\User;
use App\Mail\UserRegistered;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Locale determination
$locale = 'fr';
if (strpos(url()->current(), '/fr/') > 0) {
	$locale = 'fr';
} elseif (strpos(url()->current(), '/en/') > 0) {
	$locale = 'en';
} elseif (strpos(url()->current(), '/de/') > 0) {
	$locale = 'de';
} elseif (strpos(url()->current(), '/lu/') > 0) {
	$locale = 'lu';
}

// In case of landing page activated (use 'landing' as APP_ENV), only the landing page is available from the root address
if (app('env') == 'landing') {
	Route::get('/{slug}', function() {
		return redirect()->route('landing');
	})->where('slug', '^([a-zA-Z0-9-]{3,})$');

	Route::get('/', function() {
		return redirect()->route('landing');
	});

	Route::get('/fr', 'GeneralController@landing')->name('landing');
	Route::get('/en', 'GeneralController@landingEn')->name('landing-en');
	Route::get('/de', 'GeneralController@landingDe')->name('landing-de');
	Route::get('/lu', 'GeneralController@landingLu')->name('landing-lu');
} else {
	// Home does not need URI translation. Any locale may land on this page, middleware will ensure locale is prepended to the URI.
	// Same for auth requests, no translation needed.
	// Dashboard is also common to everyone, due to several redirections that would need to be handled in the auth process
	Route::group([
		'prefix' => '{locale?}',
		'middleware' => 'setlocale'], function() {
			Route::get('/', 'GeneralController@home')->name('home');

			Route::get('/dashboard', 'UserController@show')->name('dashboard')->middleware('createcart');
			Route::get('/dashboard/{any}', function() {
				return redirect()->route('dashboard');
			});

			Route::post('/dashboard/addresses', 'UserController@addAddress')->name('dashboard.add-address');

			Route::post('/store-newsletter', 'GeneralController@storeNewsletter')->name('newsletter-subscribe');

			Route::get('/add-kulturpass', function() {
				session(['has_kulturpass' => '1']);
				return redirect()->back();
			})->name('add-kulturpass');
			Route::get('/forget-kulturpass', function() {
				session(['has_kulturpass' => null]);
				return redirect()->back();
			})->name('forget-kulturpass');

			Route::post('/validate-stage-session', 'GeneralController@accessStage')->name('stage-access');
			
			//Auth routes
			require __DIR__.'/auth.php';
	});

	// All other routes to be localized, by language. Separated route groups for each locale allows same translations for URIs in different languages, since localized prefix will ensure route names are unique.
	Route::group([
		'prefix' => 'lu',
		'middleware' => 'setlocale'], function() {

		// Models Pages
		// Route::get('/'.trans("slugs.models", [], "lu").'/{name?}', 'ModelController@show')->name('model-lu')->middleware('createcart');
		// Route::get('/'.trans("slugs.models", [], "lu").'/{name}/'.trans("slugs.sold", [], "lu"), 'ModelController@soldItems')->name('sold-lu');
		// Route::get('/'.trans("slugs.vouchers", [], "lu"), 'GeneralController@showVouchers')->name('vouchers-lu')->middleware('createcart');

		// Client Support
		Route::get('/'.trans("slugs.client-support", [], "lu").'/{page?}', 'ContactController@showAll')->name('client-service-lu');

		// About BENU Pages
		Route::get('/'.trans("slugs.full-story", [], "lu"), 'GeneralController@showFullStory')->name('full-story-lu');
		Route::get('/'.trans("slugs.about", [], "lu"), 'GeneralController@showAbout')->name('about-lu');

		// Partners Page
		Route::get('/'.trans("slugs.partners", [], "lu"), 'GeneralController@showPartners')->name('partners-lu');

		// News pages
		Route::get('/'.trans("slugs.news", [], "lu"), 'NewsController@showAllNews')->name('news-all-lu');
		Route::get('/'.trans("slugs.news", [], "lu").'/{origin}/{slug}', 'NewsController@showNews')->name('news-lu');

		// Learn more page
		Route::get('/'.trans("slugs.learn-more", [], "lu"), 'NewsController@showLearnMore')->name('learn-more-lu');

		// Landing page
		Route::get('/test-landing-lu', 'GeneralController@landingLu')->name('landing-lu');

		// Cart and Payment Pages
		// Route::get('/'.trans("slugs.cart", [], "lu"), 'SaleController@showCart')->name('cart-lu')->middleware('createcart');

		// Route::get('/'.trans("slugs.payment", [], "lu"), 'SaleController@showPayment')->name('payment-lu');
		// Route::get('/'.trans("slugs.process-payment", [], "lu").'/{order}', 'SaleController@cardPayment')->name('payment-request-lu');
		// Route::get('/'.trans("slugs.process-paypal-payment", [], "lu").'/{order}', 'SaleController@paypalPayment')->name('payment-request-paypal-lu');
		// Route::post('/'.trans("slugs.payment-by-card", [], "lu"), 'SaleController@payByCard')->name('payment-process-lu');
		// Route::get('/'.trans("slugs.payment-validation", [], "lu").'/{order}', 'SaleController@validatePayment')->name('payment-validate-lu');
		// Route::get('/'.trans("slugs.processed-payment", [], "lu").'/{order}', 'SaleController@showValidPayment')->name('payment-processed-lu');

		// Newsletter Pages
		Route::get('/'.trans("slugs.newsletter-subscribe", [], "lu"), 'GeneralController@showNewsletter')->name('newsletter-lu');
		Route::get('/'.trans("slugs.newsletter-unsubscribe", [], "lu").'/{id}', 'GeneralController@cancelNewsletter')->name('newsletter-stop-lu');

		// Participate
		Route::get('/'.trans("slugs.header-participate", [], "lu").'/{page?}', 'GeneralController@showParticipate')->name('header.participate-lu');

		// Contact download for phone
		Route::get('/'.trans("slugs.header-download-drop-off", [], "lu"), 'GeneralController@downloadDropOff')->name('header.download-dropoff-lu');

		// Display PDF documents
		Route::get('/'.trans("slugs.return", [], "lu").'/{order_code}', 'SaleController@displayReturn')->name('return-lu');
		Route::get('/'.trans("slugs.invoice", [], "lu").'/{order_code}', 'SaleController@displayInvoice')->name('invoice-lu');
		Route::get('/'.trans("slugs.invoice-download", [], "lu").'/{order_code}', 'SaleController@downloadInvoice')->name('invoice-download-lu');
		Route::get('/'.trans("slugs.show-voucher", [], "lu").'/{voucher_code}', 'UserController@displayVoucher')->name('show-voucher-pdf-lu');

		// CSV export for admin
		Route::get('/invoice-export-csv/{year}/{month}', 'GeneralController@exportOrdersData')->name('export-invoice-csv-lu');

		// Footer Pages
		Route::get('/'.trans("slugs.footer-legal-mentions", [], "lu"), 'GeneralController@footerLegal')->name('footer.legal-lu');
		Route::get('/'.trans("slugs.footer-policy", [], "lu"), 'GeneralController@showPolicy')->name('footer.policy-lu');
		Route::get('/'.trans("slugs.footer-general-info", [], "lu"), 'GeneralController@showGeneralInfo')->name('footer.general-info-lu');
		Route::get('/'.trans("slugs.footer-medias", [], "lu"), 'GeneralController@showMedias')->name('footer.medias-lu');
		Route::get('/'.trans("slugs.general-conditions", [], "lu"), 'GeneralController@showGeneralConditions')->name('footer.general-conditions-lu');
		Route::get('/'.trans("slugs.sitemap", [], "lu"), 'GeneralController@showSiteMap')->name('footer.sitemap-lu');

		// Campaigns
		// Route::get('/'.trans("slugs.campaigns", [], "lu"), 'GeneralController@showAllCampaigns')->name('campaigns-lu');
		// Route::get('/'.trans("slugs.campaigns", [], "lu").'/{slug}', 'GeneralController@showSingleCampaign')->name('campaign-single-lu');
	});

	Route::group([
		'prefix' => 'fr',
		'middleware' => ['setlocale', 'checkKulturpass'],
	], function() {

		// Models Pages
		// Route::get('/'.trans("slugs.models", [], "fr").'/{name?}', 'ModelController@show')->name('model-fr')->middleware('createcart');
		// Route::get('/'.trans("slugs.models", [], "fr").'/{name}/'.trans("slugs.sold", [], "fr"), 'ModelController@soldItems')->name('sold-fr');
		// Route::get('/'.trans("slugs.vouchers", [], "fr"), 'GeneralController@showVouchers')->name('vouchers-fr')->middleware('createcart');

		// Client Support
		Route::get('/'.trans("slugs.client-support", [], "fr").'/{page?}', 'ContactController@showAll')->name('client-service-fr');

		// About BENU Pages
		Route::get('/'.trans("slugs.full-story", [], "fr"), 'GeneralController@showFullStory')->name('full-story-fr');
		Route::get('/'.trans("slugs.about", [], "fr"), 'GeneralController@showAbout')->name('about-fr');

		// Partners Page
		Route::get('/'.trans("slugs.partners", [], "fr"), 'GeneralController@showPartners')->name('partners-fr');

		// News pages
		Route::get('/'.trans("slugs.news", [], "fr"), 'NewsController@showAllNews')->name('news-all-fr');
		Route::get('/'.trans("slugs.news", [], "fr").'/{origin}/{slug}', 'NewsController@showNews')->name('news-fr');

		// Landing page
		Route::get('/test-landing-fr', 'GeneralController@landingLu')->name('landing-fr');

		// Cart and Payment Pages
		// Route::get('/'.trans("slugs.cart", [], "fr"), 'SaleController@showCart')->name('cart-fr')->middleware('createcart');

		// Route::get('/'.trans("slugs.payment", [], "fr"), 'SaleController@showPayment')->name('payment-fr');
		// Route::get('/'.trans("slugs.process-payment", [], "fr").'/{order}', 'SaleController@cardPayment')->name('payment-request-fr');
		// Route::get('/'.trans("slugs.process-paypal-payment", [], "fr").'/{order}', 'SaleController@paypalPayment')->name('payment-request-paypal-fr');
		// Route::post('/'.trans("slugs.payment-by-card", [], "fr"), 'SaleController@payByCard')->name('payment-process-fr');
		// Route::get('/'.trans("slugs.payment-validation", [], "fr").'/{order}', 'SaleController@validatePayment')->name('payment-validate-fr');
		// Route::get('/'.trans("slugs.processed-payment", [], "fr").'/{order}', 'SaleController@showValidPayment')->name('payment-processed-fr');

		// Newsletter Pages
		Route::get('/'.trans("slugs.newsletter-subscribe", [], "fr"), 'GeneralController@showNewsletter')->name('newsletter-fr');
		Route::get('/'.trans("slugs.newsletter-unsubscribe", [], "fr").'/{id}', 'GeneralController@cancelNewsletter')->name('newsletter-stop-fr');

		// Participate
		Route::get('/'.trans("slugs.header-participate", [], "fr").'/{page?}', 'GeneralController@showParticipate')->name('header.participate-fr');

		// Contact download for phone
		Route::get('/'.trans("slugs.header-download-drop-off", [], "fr"), 'GeneralController@downloadDropOff')->name('header.download-dropoff-fr');

		// Display PDF documents
		Route::get('/'.trans("slugs.return", [], "fr").'/{order_code}', 'SaleController@displayReturn')->name('return-fr');
		Route::get('/'.trans("slugs.invoice", [], "fr").'/{order_code}', 'SaleController@displayInvoice')->name('invoice-fr');
		Route::get('/'.trans("slugs.invoice-download", [], "fr").'/{order_code}', 'SaleController@downloadInvoice')->name('invoice-download-fr');
		Route::get('/'.trans("slugs.show-voucher", [], "fr").'/{voucher_code}', 'UserController@displayVoucher')->name('show-voucher-pdf-fr');

		// CSV export for admin
		Route::get('/invoice-export-csv/{year}/{month}', 'GeneralController@exportOrdersData')->name('export-invoice-csv-fr');

		// Footer Pages
		Route::get('/'.trans("slugs.footer-legal-mentions", [], "fr"), 'GeneralController@footerLegal')->name('footer.legal-fr');
		Route::get('/'.trans("slugs.footer-policy", [], "fr"), 'GeneralController@showPolicy')->name('footer.policy-fr');
		Route::get('/'.trans("slugs.footer-general-info", [], "fr"), 'GeneralController@showGeneralInfo')->name('footer.general-info-fr');
		Route::get('/'.trans("slugs.footer-medias", [], "fr"), 'GeneralController@showMedias')->name('footer.medias-fr');
		Route::get('/'.trans("slugs.general-conditions", [], "fr"), 'GeneralController@showGeneralConditions')->name('footer.general-conditions-fr');
		Route::get('/'.trans("slugs.sitemap", [], "fr"), 'GeneralController@showSiteMap')->name('footer.sitemap-fr');

		// Campaigns
		// Route::get('/'.trans("slugs.campaigns", [], "fr"), 'GeneralController@showAllCampaigns')->name('campaigns-fr');
		// Route::get('/'.trans("slugs.campaigns", [], "fr").'/{slug}', 'GeneralController@showSingleCampaign')->name('campaign-single-fr');

		// Test and data importation pages - for admin only
		Route::get('/test-mail', function() {
			$user = User::find(2);

			return new UserRegistered($user);
		});
		Route::get('/import-data', 'GeneralController@startImport');

		// Launch page
		Route::get('/launch', 'GeneralController@launchWebsite')->name('launch');
	});

	Route::group([
		'prefix' => 'en',
		'middleware' => 'setlocale'], function() {

		// Models Pages
		// Route::get('/'.trans("slugs.models", [], "en").'/{name?}', 'ModelController@show')->name('model-en')->middleware('createcart');
		// Route::get('/'.trans("slugs.models", [], "en").'/{name}/'.trans("slugs.sold", [], "en"), 'ModelController@soldItems')->name('sold-en');
		// Route::get('/'.trans("slugs.vouchers", [], "en"), 'GeneralController@showVouchers')->name('vouchers-en')->middleware('createcart');

		// Client Support
		Route::get('/'.trans("slugs.client-support", [], "en").'/{page?}', 'ContactController@showAll')->name('client-service-en');

		// About BENU Pages
		Route::get('/'.trans("slugs.full-story", [], "en"), 'GeneralController@showFullStory')->name('full-story-en');
		Route::get('/'.trans("slugs.about", [], "en"), 'GeneralController@showAbout')->name('about-en');

		// Partners Page
		Route::get('/'.trans("slugs.partners", [], "en"), 'GeneralController@showPartners')->name('partners-en');

		// News pages
		Route::get('/'.trans("slugs.news", [], "en"), 'NewsController@showAllNews')->name('news-all-en');
		Route::get('/'.trans("slugs.news", [], "en").'/{origin}/{slug}', 'NewsController@showNews')->name('news-en');

		// Landing page
		Route::get('/test-landing-en', 'GeneralController@landingLu')->name('landing-en');

		// Cart and Payment Pages
		// Route::get('/'.trans("slugs.cart", [], "en"), 'SaleController@showCart')->name('cart-en')->middleware('createcart');

		// Route::get('/'.trans("slugs.payment", [], "en"), 'SaleController@showPayment')->name('payment-en');
		// Route::get('/'.trans("slugs.process-payment", [], "en").'/{order}', 'SaleController@cardPayment')->name('payment-request-en');
		// Route::get('/'.trans("slugs.process-paypal-payment", [], "en").'/{order}', 'SaleController@paypalPayment')->name('payment-request-paypal-en');
		// Route::post('/'.trans("slugs.payment-by-card", [], "en"), 'SaleController@payByCard')->name('payment-process-en');
		// Route::get('/'.trans("slugs.payment-validation", [], "en").'/{order}', 'SaleController@validatePayment')->name('payment-validate-en');
		// Route::get('/'.trans("slugs.processed-payment", [], "en").'/{order}', 'SaleController@showValidPayment')->name('payment-processed-en');

		// Newsletter Pages
		Route::get('/'.trans("slugs.newsletter-subscribe", [], "en"), 'GeneralController@showNewsletter')->name('newsletter-en');
		Route::get('/'.trans("slugs.newsletter-unsubscribe", [], "en").'/{id}', 'GeneralController@cancelNewsletter')->name('newsletter-stop-en');

		// Participate
		Route::get('/'.trans("slugs.header-participate", [], "en").'/{page?}', 'GeneralController@showParticipate')->name('header.participate-en');

		// Contact download for phone
		Route::get('/'.trans("slugs.header-download-drop-off", [], "en"), 'GeneralController@downloadDropOff')->name('header.download-dropoff-en');

		// Display PDF documents
		Route::get('/'.trans("slugs.return", [], "en").'/{order_code}', 'SaleController@displayReturn')->name('return-en');
		Route::get('/'.trans("slugs.invoice", [], "en").'/{order_code}', 'SaleController@displayInvoice')->name('invoice-en');
		Route::get('/'.trans("slugs.invoice-download", [], "en").'/{order_code}', 'SaleController@downloadInvoice')->name('invoice-download-en');
		Route::get('/'.trans("slugs.show-voucher", [], "en").'/{voucher_code}', 'UserController@displayVoucher')->name('show-voucher-pdf-en');

		// CSV export for admin
		Route::get('/invoice-export-csv/{year}/{month}', 'GeneralController@exportOrdersData')->name('export-invoice-csv-en');

		// Footer Pages
		Route::get('/'.trans("slugs.footer-legal-mentions", [], "en"), 'GeneralController@footerLegal')->name('footer.legal-en');
		Route::get('/'.trans("slugs.footer-policy", [], "en"), 'GeneralController@showPolicy')->name('footer.policy-en');
		Route::get('/'.trans("slugs.footer-general-info", [], "en"), 'GeneralController@showGeneralInfo')->name('footer.general-info-en');
		Route::get('/'.trans("slugs.footer-medias", [], "en"), 'GeneralController@showMedias')->name('footer.medias-en');
		Route::get('/'.trans("slugs.general-conditions", [], "en"), 'GeneralController@showGeneralConditions')->name('footer.general-conditions-en');
		Route::get('/'.trans("slugs.sitemap", [], "en"), 'GeneralController@showSiteMap')->name('footer.sitemap-en');

		// Campaigns
		// Route::get('/'.trans("slugs.campaigns", [], "en"), 'GeneralController@showAllCampaigns')->name('campaigns-en');
		// Route::get('/'.trans("slugs.campaigns", [], "en").'/{slug}', 'GeneralController@showSingleCampaign')->name('campaign-single-en');
	});

	Route::group([
		'prefix' => 'de',
		'middleware' => 'setlocale'], function() {

		// Models Pages
		// Route::get('/'.trans("slugs.models", [], "de").'/{name?}', 'ModelController@show')->name('model-de')->middleware('createcart');
		// Route::get('/'.trans("slugs.models", [], "de").'/{name}/'.trans("slugs.sold", [], "de"), 'ModelController@soldItems')->name('sold-de');
		// Route::get('/'.trans("slugs.vouchers", [], "de"), 'GeneralController@showVouchers')->name('vouchers-de')->middleware('createcart');

		// Client Support
		Route::get('/'.trans("slugs.client-support", [], "de").'/{page?}', 'ContactController@showAll')->name('client-service-de');

		// About BENU Pages
		Route::get('/'.trans("slugs.full-story", [], "de"), 'GeneralController@showFullStory')->name('full-story-de');
		Route::get('/'.trans("slugs.about", [], "de"), 'GeneralController@showAbout')->name('about-de');

		// Partners Page
		Route::get('/'.trans("slugs.partners", [], "de"), 'GeneralController@showPartners')->name('partners-de');

		// News pages
		Route::get('/'.trans("slugs.news", [], "de"), 'NewsController@showAllNews')->name('news-all-de');
		Route::get('/'.trans("slugs.news", [], "de").'/{origin}/{slug}', 'NewsController@showNews')->name('news-de');

		// Landing page
		Route::get('/test-landing-de', 'GeneralController@landingLu')->name('landing-de');

		// Cart and Payment Pages
		// Route::get('/'.trans("slugs.cart", [], "de"), 'SaleController@showCart')->name('cart-de')->middleware('createcart');

		// Route::get('/'.trans("slugs.payment", [], "de"), 'SaleController@showPayment')->name('payment-de');
		// Route::get('/'.trans("slugs.process-payment", [], "de").'/{order}', 'SaleController@cardPayment')->name('payment-request-de');
		// Route::get('/'.trans("slugs.process-paypal-payment", [], "de").'/{order}', 'SaleController@paypalPayment')->name('payment-request-paypal-de');
		// Route::post('/'.trans("slugs.payment-by-card", [], "de"), 'SaleController@payByCard')->name('payment-process-de');
		// Route::get('/'.trans("slugs.payment-validation", [], "de").'/{order}', 'SaleController@validatePayment')->name('payment-validate-de');
		// Route::get('/'.trans("slugs.processed-payment", [], "de").'/{order}', 'SaleController@showValidPayment')->name('payment-processed-de');

		// Newsletter Pages
		Route::get('/'.trans("slugs.newsletter-subscribe", [], "de"), 'GeneralController@showNewsletter')->name('newsletter-de');
		Route::get('/'.trans("slugs.newsletter-unsubscribe", [], "de").'/{id}', 'GeneralController@cancelNewsletter')->name('newsletter-stop-de');

		// Participate
		Route::get('/'.trans("slugs.header-participate", [], "de").'/{page?}', 'GeneralController@showParticipate')->name('header.participate-de');

		// Contact download for phone
		Route::get('/'.trans("slugs.header-download-drop-off", [], "de"), 'GeneralController@downloadDropOff')->name('header.download-dropoff-de');

		// Display PDF documents
		Route::get('/'.trans("slugs.return", [], "de").'/{order_code}', 'SaleController@displayReturn')->name('return-de');
		Route::get('/'.trans("slugs.invoice", [], "de").'/{order_code}', 'SaleController@displayInvoice')->name('invoice-de');
		Route::get('/'.trans("slugs.invoice-download", [], "de").'/{order_code}', 'SaleController@downloadInvoice')->name('invoice-download-de');
		Route::get('/'.trans("slugs.show-voucher", [], "de").'/{voucher_code}', 'UserController@displayVoucher')->name('show-voucher-pdf-de');
		// CSV export for admin
		Route::get('/invoice-export-csv/{year}/{month}', 'GeneralController@exportOrdersData')->name('export-invoice-csv-de');

		// Footer Pages
		Route::get('/'.trans("slugs.footer-legal-mentions", [], "de"), 'GeneralController@footerLegal')->name('footer.legal-de');
		Route::get('/'.trans("slugs.footer-policy", [], "de"), 'GeneralController@showPolicy')->name('footer.policy-de');
		Route::get('/'.trans("slugs.footer-general-info", [], "de"), 'GeneralController@showGeneralInfo')->name('footer.general-info-de');
		Route::get('/'.trans("slugs.footer-medias", [], "de"), 'GeneralController@showMedias')->name('footer.medias-de');
		Route::get('/'.trans("slugs.general-conditions", [], "de"), 'GeneralController@showGeneralConditions')->name('footer.general-conditions-de');
		Route::get('/'.trans("slugs.sitemap", [], "de"), 'GeneralController@showSiteMap')->name('footer.sitemap-de');

		// Campaigns
		// Route::get('/'.trans("slugs.campaigns", [], "de"), 'GeneralController@showAllCampaigns')->name('campaigns-de');
		// Route::get('/'.trans("slugs.campaigns", [], "de").'/{slug}', 'GeneralController@showSingleCampaign')->name('campaign-single-de');
	});

	Route::group([
		'middleware' => 'setlocale'], function() {
		Route::get('/{slug?}', 'ModelController@show')->where('slug', '[a-zA-Z0-9]{3,}');
	});
}