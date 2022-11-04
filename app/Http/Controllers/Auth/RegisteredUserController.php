<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

use App\Models\Address;
use App\Models\DeliveryCountry;
use App\Models\Kulturpass;
use App\Models\User;
use App\Mail\UserRegistered;
use App\Mail\NewsletterConfirmation;
use App\Mail\NewsletterConfirmationForAdmin;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $localized_country = "country_".app()->getLocale();
        // $country_options = DeliveryCountry::all();
        $nearby_countries = DeliveryCountry::where('country_code', 'DE')
                                            ->orWhere('country_code', 'BE')
                                            ->orWhere('country_code', 'FR')
                                            ->orWhere('country_code', 'LU')
                                            ->get();
        $country_options = DeliveryCountry::where('country_code', '<>', 'DE')
                                            ->where('country_code', '<>', 'BE')
                                            ->where('country_code', '<>', 'FR')
                                            ->where('country_code', '<>', 'LU')
                                            ->orderBy($localized_country, 'asc')
                                            ->get();

        return view('auth.register', ['nearby_countries' => $nearby_countries, 'country_options' => $country_options, 'localized_country' => $localized_country]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // dd(config('mail.mailers.smtp_admin.admin_receiver'), config('mail.mailers.smtp_admin.sender'), config('mail.mailers.smtp_admin.username'), config('mail.mailers.smtp_admin.password'));
        app()->setLocale(session('locale'));

        $user_exists = 0;
        $email_rule = 'unique:mysql_common.users';
        // Case user already existed, and was soft deleted
        // if (isset($request->email) && User::withTrashed()->where('email', $request->email)->count() > 0) {
        //     $user_exists = 1;
        //     $email_rule = "";
        // }
        if (isset($request->email) && User::where('email', $request->email)->count() > 0) {
            $user_exists = 1;
            $email_rule = "";
        } elseif (isset($request->email) && User::withTrashed()->where('email', $request->email)->count() > 0) {
            return redirect()->back()->with('account-deleted', 'This account has been deleted and cannot be reactivated. Please contact us if you need to restore your account.');
        }

        //Newsletter boolean to false if not checked
        if (!isset($request->register_newsletter)) {
            $request->register_newsletter = 0;
        }

        //Client number created randomly  - C#####
        $client_number = "C".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
        while (User::withTrashed()->where('client_number', $client_number)->count() > 0) {
            $client_number = "C".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
        }

        $address_entered = false;
        
        //Case any address field has been provided, address info then becomes required
        if (isset($request->register_address_name) && strlen($request->register_address_name) > 0
            || isset($request->register_address_first_name) && strlen($request->register_address_first_name) > 0
            || isset($request->register_address_last_name) && strlen($request->register_address_last_name) > 0
            || isset($request->register_address_number) && strlen($request->register_address_number) > 0
            || isset($request->register_address_street) && strlen($request->register_address_street) > 0
            || isset($request->register_address_floor) && strlen($request->register_address_floor) > 0
            || isset($request->register_address_city) && strlen($request->register_address_city) > 0
            || isset($request->register_address_zip) && strlen($request->register_address_zip) > 0
            || isset($request->register_address_phone) && strlen($request->register_address_phone) > 0
            || isset($request->register_address_other) && strlen($request->register_address_other) > 0) {

            $address_entered = true;
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', $email_rule],
                'register_password' => ['required', 'confirmed', Rules\Password::defaults()],
                'register_company' => ['nullable', 'string', 'max:255'],
                'register_phone' => ['required', 'string', 'min:6', 'max:30', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
                'register_gender' => ['nullable', 'string', 'max:7', Rule::in(['male', 'female', 'neutral'])],
                'register_first_name' => ['required', 'string', 'max:255'],
                'register_last_name' => ['required', 'string', 'max:255'],
                'register_age' => ['required', 'integer'],
                'register_legal' => ['required', 'integer'],
                'register_newsletter' => ['integer'],
                'register_address_name' => ['required', 'string', 'max:150'],
                'register_address_first_name' => ['required', 'string', 'max:255'],
                'register_address_last_name' => ['required', 'string', 'max:255'],
                'register_address_number' => ['required', 'integer'],
                'register_address_street' => ['required', 'string', 'max:255'],
                'register_address_floor' => ['nullable', 'string', 'max:255'],
                'register_address_city' => ['required', 'string', 'max:150'],
                'register_address_zip' => ['required', 'string', 'max:10'],
                'register_address_phone' => ['required', 'string', 'min:6', 'max:30', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
                'register_address_country' => ['required', 'string', 'max:50'],
                'register_address_other' => ['nullable', 'string', 'max:255'],
                'register_kulturpass' => ['nullable', 'mimes:pdf,jpg,jpeg,png,bmp,doc,docx', 'max:6144'],
            ]);

            $new_address = new Address();
            $new_address->address_name = $request->register_address_name;
            $new_address->first_name = $request->register_address_first_name;
            $new_address->last_name = $request->register_address_last_name;
            $new_address->street_number = (int) $request->register_address_number;
            $new_address->street = $request->register_address_street;
            if (isset($request->register_address_floor)) {
                $new_address->floor = $request->register_address_floor;
            }
            $new_address->zip_code = $request->register_address_zip;
            $new_address->phone = $request->register_address_phone;
            $new_address->city = $request->register_address_city;
            $new_address->country = $request->register_address_country;
            if (isset($request->register_address_other)) {
                $new_address->other_infos = $request->register_address_other;
            }

        } else { //case no address provided, address data is nullable
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', $email_rule],
                'register_password' => ['required', 'confirmed', Rules\Password::defaults()],
                'register_company' => ['nullable', 'string', 'max:255'],
                'register_phone' => ['required', 'string', 'min:6', 'max:30', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
                'register_gender' => ['nullable', 'string', 'max:7', Rule::in(['male', 'female', 'neutral'])],
                'register_first_name' => ['required', 'string', 'max:255'],
                'register_last_name' => ['required', 'string', 'max:255'],
                'register_age' => ['required', 'integer'],
                'register_legal' => ['required', 'integer'],
                'register_newsletter' => ['integer'],
                'register_address_name' => ['nullable', 'string', 'max:150'],
                'register_address_first_name' => ['nullable', 'string', 'max:255'],
                'register_address_last_name' => ['nullable', 'string', 'max:255'],
                'register_address_number' => ['nullable', 'integer'],
                'register_address_street' => ['nullable', 'string', 'max:255'],
                'register_address_floor' => ['nullable', 'string', 'max:255'],
                'register_address_city' => ['nullable', 'string', 'max:150'],
                'register_address_zip' => ['nullable', 'string', 'max:10'],
                'register_address_phone' => ['nullable', 'string', 'min:6', 'max:30', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
                'register_address_country' => ['nullable', 'string', 'max:50'],
                'register_address_other' => ['nullable', 'string', 'max:255'],
                'register_kulturpass' => ['nullable', 'mimes:pdf,jpg,jpeg,png,bmp,doc,docx', 'max:6144'],
            ]);
        }

        if (!$user_exists) {
            //Create user in any case, even if no address has been added
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->register_password),
                'role' => 'user',
                'first_name' => $request->register_first_name,
                'last_name' => $request->register_last_name,
                'gender' => $request->register_gender,
                'company' => $request->register_company,
                'phone' => $request->register_phone,
                'is_over_18' => $request->register_age,
                'legal_ok' => $request->register_legal,
                'last_conditions_agreed' => 1,
                'favorite_language' => session('locale'),
                'newsletter' => $request->register_newsletter,
                'origin' => 'couture',
                'client_number' => $client_number,
                'general_comment' => "No comment",
                'delete_feedback' => "",
            ]);
        } else {
            return redirect()->back()->with('account-deleted', 'Account already exists. Please log in with your e-mail address and password.');

            // To be used if trashed user should be restored - currently deactivated
            $user = User::withTrashed()->where('email', $request->email)->first();
            $user->restore();
            $user->update([
                'password' => Hash::make($request->register_password),
                'role' => 'user',
                'first_name' => $request->register_first_name,
                'last_name' => $request->register_last_name,
                'gender' => $request->register_gender,
                'company' => $request->register_company,
                'phone' => $request->register_phone,
                'is_over_18' => $request->register_age,
                'legal_ok' => $request->register_legal,
                'last_conditions_agreed' => 1,
                'favorite_language' => session('locale'),
                'newsletter' => $request->register_newsletter,
                'origin' => 'couture',
            ]);
        }

        //User creation was required to establish user_id
        if ($address_entered) {
            $new_address->user_id = $user->id;
            $new_address->save();
        }

        if ($request->file('register_kulturpass') !== null) {
            $filename = 'kulturpass-'.$user->id.date('dmYHis').'-'.$user->first_name.'-'.$user->last_name.'.'.$request->file('register_kulturpass')->extension();
            $path = $request->file('register_kulturpass')->storeAs(
                'kulturpasses', $filename, 'local'
            );

            // Storage::disk('local')->putFile('kulturpasses', new File($request->register_kulturpass), 'kulturpass-'.$user->id.'-'.$user->first_name.'-'.$user->last_name.'.'.$request->file('register_kulturpass')->);

            $new_kulturpass = new Kulturpass();
            $new_kulturpass->user_id = $user->id;
            $new_kulturpass->file_name = $filename;
            $new_kulturpass->save();
        }

        Mail::mailer('smtp_admin')->to($user->email)->bcc(config('mail.mailers.smtp_admin.sender'))->send(new UserRegistered($user));

        if ($user->newsletter && app('env') == 'prod') {
            // Mail::to($user->email)->send(new NewsletterConfirmation());
            Mail::mailer('smtp_admin')->to(config('mail.mailers.smtp_admin.admin_receiver'))->send(new NewsletterConfirmationForAdmin($user));
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::DASHBOARD);
    }
}
