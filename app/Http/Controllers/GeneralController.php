<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;

use App\Models\Article;
use App\Models\Creation;
use App\Models\CreationCategory;
use App\Models\NewsArticleCouture;
use App\Models\Partner;
use App\Models\User;
use App\Models\Media;
use App\Models\VillageInfo;
use App\Mail\NewsletterConfirmation;
use App\Mail\NewsletterConfirmationForAdmin;
use App\Mail\NewsletterCancelConfirmationForAdmin;
use App\Exports\OrdersExport;

use App\Traits\ArticleAnalyzer;
use App\Traits\DataImporter;

use App\Http\Requests\NewsletterRequest;

use JeroenDesloovere\VCard\VCard;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Translation;

class GeneralController extends Controller
{
    use ArticleAnalyzer;
    use DataImporter;

    public function home()
    {
        // Temp - translations check
        // $translations = Translation::all();
        // $missing_translations = [];
        // foreach ($translations as $translation) {
        //     if ($translation->fr == "" && $translation->en == "" && $translation->de == "" && $translation->lu == "") {
        //         array_push($missing_translations, $translation->page.'.'.$translation->key.' - No translation at all');
        //     } elseif ($translation->fr == "" || $translation->en == "" || $translation->de == "" || $translation->lu == "") {
        //         array_push($missing_translations, $translation->page.'.'.$translation->key.' - Missing languages');
        //     }
        // }

        // dd($missing_translations);

        // Reset payment on-going status to reach dashboard after connect
        session(['payment-ongoing' => 'inactive']);

        // Include last 6 creations where at least 1 article is present and in stock
        $latest_models = $this->getAvailableCreations()->slice(0, 6);

        return view('welcome', ['latest_models' => $latest_models]);
    }

    public function landing()
    {
        return view('landing');
    }

    public function landingEn()
    {
        return view('landing-en');
    }

    public function landingDe()
    {
        return view('landing-de');
    }

    public function landingLu()
    {
        return view('landing-lu');
    }

    public function showFullStory()
    {
        return view('header.pages.full-story');
    }

    public function showAbout()
    {
        return view('header.pages.about');
    }

    public function showPartners()
    {
        return redirect()->route('home', ['locale' => app()->getLocale()]);
        $partners = Partner::orderBy('created_at', 'desc')->get();
        $localized_desc_query = "description_".app()->getLocale();
        return view('partners', ['partners' => $partners, 'desc_query' => $localized_desc_query]);
    }

    public function showVouchers()
    {
        $vouchers = Article::where('name', 'voucher')->orderBy('voucher_type', 'asc')->get();

        return view('vouchers', ['vouchers' => $vouchers]);
    }

    public function showNewsletter()
    {
        $random_1 = random_int(1, 10);
        $random_2 = random_int(1, 10);
        return view('newsletter', ['random_1' => $random_1, 'random_2' => $random_2]);
    }

    public function storeNewsletter(NewsletterRequest $request)
    {
        $message = "";
        if ($request->newsletter_checksum_1 + $request->newsletter_checksum_2 == $request->newsletter_checksum) {
            if (auth()->check()) {
                if (auth()->user()->newsletter == '2') {
                    auth()->user()->newsletter = 3;
                    auth()->user()->save();

                    if(app('env') == 'prod') {
                        Mail::mailer('smtp_admin')->to(config('mail.mailers.smtp_admin.admin_receiver'))->send(new NewsletterCancelConfirmationForAdmin(auth()->user()));
                    } else {
                        Mail::mailer('smtp_admin')->to('paul.guillard@benu.lu')->send(new NewsletterCancelConfirmationForAdmin(auth()->user()));
                    }

                    $message = __('auth.newsletter-unsubscribe-pending');
                    return redirect()->route('newsletter-'.session('locale'))->with('cancellation', $message);
                } else {
                    auth()->user()->newsletter = 1;
                    auth()->user()->favorite_language = session('locale');
                    auth()->user()->save();
                    $message = __('auth.newsletter-subscribe-confirm');
                    // Mail::to(auth()->user()->email)->send(new NewsletterConfirmation(auth()->user()));
                    if(app('env') == 'prod') {
                        Mail::mailer('smtp_admin')->to(config('mail.mailers.smtp_admin.admin_receiver'))->send(new NewsletterConfirmationForAdmin(auth()->user()));
                    } else {
                        Mail::mailer('smtp_admin')->to('paul.guillard@benu.lu')->send(new NewsletterConfirmationForAdmin(auth()->user()));
                    }

                    $message = __('auth.newsletter-subscribe-pending');
                    return redirect()->route('newsletter-'.session('locale'))->with('subscription', $message);
                }
            } else {
                if (User::where('email', $request->newsletter_email)->count() > 0) {
                    $user = User::where('email', $request->newsletter_email)->first();
                    $user->newsletter = 1;
                    $user->favorite_language = session('locale');
                    $user->save();
                    $message = __('auth.newsletter-subscribe-confirm');
                    // Mail::to($user->email)->send(new NewsletterConfirmation($user));
                    
                    if(app('env') == 'prod') {
                        Mail::mailer('smtp_admin')->to(config('mail.mailers.smtp_admin.admin_receiver'))->send(new NewsletterConfirmationForAdmin($user));
                    } else {
                        Mail::mailer('smtp_admin')->to('paul.guillard@benu.lu')->send(new NewsletterConfirmationForAdmin($user));
                    }
                } else {
                    $blacklist = ['59.120.51.46'];
                    if (!in_array($request->ip(), $blacklist)) {
                        $user = new User();
                        $user->email = $request->newsletter_email;
                        $client_number = "C".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                        while (User::where('client_number', $client_number)->count() > 0) {
                            $client_number = "C".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                        }

                        $user->client_number = $client_number;
                        $user->first_name = $request->newsletter_first_name;
                        $user->last_name = $request->newsletter_last_name;
                        $user->newsletter = 1;
                        $user->role = 'newsletter';
                        $user->favorite_language = session('locale');
                        $user->general_comment = "";
                        if($user->save()) {
                            $message = __('auth.newsletter-subscribe-confirm');
                            // Mail::to($user->email)->send(new NewsletterConfirmation($user));
                            
                            if(app('env') == 'prod') {
                                Mail::mailer('smtp_admin')->to(config('mail.mailers.smtp_admin.admin_receiver'))->send(new NewsletterConfirmationForAdmin($user));
                            } else {
                                Mail::mailer('smtp_admin')->to('paul.guillard@benu.lu')->send(new NewsletterConfirmationForAdmin($user));
                            }
                        }
                    }
                }
                return redirect()->route('newsletter-'.session('locale'))->with('subscription', $message);
            }
        }
        return redirect()->route('newsletter-'.session('locale'));

    }

    public function cancelNewsletter(string $id)
    {
        $user_id = substr($id, 6);
        if (User::find($user_id)) {
            $user = User::find($user_id);
            if ($user->newsletter == '2') {
                $user->newsletter = 3;
                $user->save();
                
                if(app('env') == 'prod') {
                    Mail::mailer('smtp_admin')->to(config('mail.mailers.smtp_admin.admin_receiver'))->send(new NewsletterCancelConfirmationForAdmin($user));
                } else {
                    Mail::mailer('smtp_admin')->to('paul.guillard@benu.lu')->send(new NewsletterCancelConfirmationForAdmin($user));
                }
            }
            return view('newsletter-cancelled');
        }
    }

    public function footerLegal()
    {
        return view('footer.pages.legal');
    }

    public function showParticipate($page = '')
    {
        // When changing locale while in a sub-section of the page, redirect to the page without parameter. Also handles random URI parameters.
        if (!in_array($page, [
            __('slugs.participate-badges'),
            __('slugs.participate-give'),
            __('slugs.participate-partnership'),
            __('slugs.participate-smart'),
            __('slugs.participate-sustainable'),
            ''
        ])) {
            return redirect()->route('header.participate-'.app()->getLocale());
        }

        if ($page == __('slugs.participate-badges')) {
            // Specific to badges section - initialize collection before if
        }

        if ($page == __('slugs.participate-give')) {
            // Specific to give clothes section - initialize collection before if
        }

        if ($page == __('slugs.participate-partnership') || $page == '') {
            
        }

        // $localized_desc_query = "description_".app()->getLocale();

        return view('header.pages.participate', ['page' => $page]);
    }


    public function downloadDropOff(Request $request)
    {
        // define vcard
        $vcard = new VCard();

        // define variables
        $lastname = $request->last_name;
        $firstname = $request->first_name;
        $additional = '';
        $prefix = '';
        $suffix = '';

        // add personal data
        $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

        // add phone
        $vcard->addPhoneNumber($request->phone, 'PREF;WORK');

        // return vcard as a download
        // return $vcard->download();
        // The following response is created and returned to avoid bugs with iOs
        $response = new Response();
        $response->setContent($vcard->getOutput());
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/x-vcard');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $firstname . $lastname . '.vcf"');
        $response->headers->set('Content-Length', mb_strlen($vcard->getOutput(), 'utf-8'));

        return $response;
    }


    public function showPolicy()
    {
        return view('footer.pages.policy');
    }


    public function showGeneralInfo()
    {
        return view('footer.pages.general-info');
    }


    public function showMedias()
    {
        $articles = Media::where('family', 'article')->orderBy('publication_date', 'desc')->get();
        $podcasts = Media::where('family', 'radio')->orderBy('publication_date', 'desc')->get();
        $videos = Media::where('family', 'video')->orderBy('publication_date', 'desc')->get();
        $web_publications = Media::where('family', 'web')->orderBy('publication_date', 'desc')->get();

        return view('footer.pages.medias', [
            'articles' => $articles,
            'podcasts' => $podcasts,
            'videos' => $videos,
            'web_publications' => $web_publications,
        ]);
    }


    public function showGeneralConditions()
    {
        return view('footer.pages.general-conditions');
    }


    public function showAllCampaigns()
    {
        return view('campaigns');
    }

    public function showSingleCampaign(string $slug)
    {
        $campaign_slugs = [
            'carte-blanche',
        ];

        if (in_array($slug, $campaign_slugs)) {
            return view('campaigns.campaign-white-card');
        }
    }


    public function showSiteMap()
    {
        $clothes = $this->getAvailableCreations('clothes')->sortBy('name');
        $accessories = $this->getAvailableCreations('accessories')->sortBy('name');
        $home_items = $this->getAvailableCreations('home')->sortBy('name');
        // $news = NewsArticleCouture::where('is_ready', '1')->orderBy('updated_at', 'desc')->get();
        $couture_news = NewsArticleCouture::where('is_ready', '1')->orderBy('updated_at', 'desc')->get();
        $village_news = VillageInfo::where('is_ready', '1')->orderBy('updated_at', 'desc')->get();
        return view('footer.pages.sitemap', [
            'clothes' => $clothes, 
            'accessories' => $accessories, 
            'home_items' => $home_items, 
            'couture_news' => $couture_news,
            'village_news' => $village_news,
        ]);
    }


    public function exportOrdersData(int $year, int $month) 
    {
        if (auth()->check() && auth()->user()->role == 'admin') {
            return Excel::download(new OrdersExport($year, $month), 'orders-'.str_pad($month, 2, '0', STR_PAD_LEFT).'-'.$year.'.csv');
        }
    }


    public function launchWebsite()
    {
        return view('launch-intro');
    }


    public function accessStage(Request $request)
    {
        if ($request->stage_password == 'benew') {
            session(['stage_checked' => 'OK']);
            return redirect()->back();
        } else {
            return redirect()->back()->with('msg', "Wrong password :(");
        }
    }


    public function startImport()
    {
        if(auth::check() && auth::user()->role == 'admin') {
            echo "*** Time limit set to 3600s ***<br/>";
            set_time_limit(3600);

            echo "*** Translations importation started ***<br/>";
            $this->importTranslations();

            echo "*** Importation process complete! :) ***<br/>";
        } else {
            return redirect()->route('login-fr');
        }
    }
}
