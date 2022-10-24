<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;

use App\Notifications\BenuResetPasswordNotification;

use App\Models\ContactMessage;

use Laravel\Cashier\Billable;

use Illuminate\Support\Facades\Mail;

use App\Mail\NewPasswordLink;

class User extends Authenticatable implements HasName, FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Billable;

    // Choice of the database
    protected $connection = 'mysql_common';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'gender',
        'company',
        'phone',
        'first_name',
        'last_name',
        'email',
        'password',
        'is_over_18',
        'legal_ok',
        'newsletter',
        'origin',
        'client_number',
        'general_comment',
        'favorite_language',
        'last_conditions_agreed',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    // For Filament
    public function getFilamentName(): string
    {
        return $this->first_name;
    }

    /**
   * Get the user's full name.
   *
   * @return string
   */ 
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function canAccessFilament(): bool
    {
        return ($this->role == 'admin' || $this->role == 'vendor' || $this->role == 'editor');
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function kulturpasses()
    {
        return $this->hasMany('App\Models\Kulturpass');
    }

    public function wishlistArticles()
    {
        if(App::environment('stage')) {
            return $this->belongsToMany('App\Models\Article', 'benu_common_stage.couture_article_user');
        }
        return $this->belongsToMany('App\Models\Article', 'benu_common.couture_article_user');
    }

    public function contactMessages()
    {
        return ContactMessage::where('email', $this->email);
    }

    public function openContactMessages()
    {
        return ContactMessage::where('email', $this->email)->where('closed', '0');
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function badges() 
    {
        return $this->belongsToMany(Badge::class)->withTimestamps();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        // For customized password reset e-mail, bypass framework process
        $email = $this->getEmailForPasswordReset();
        $route = url(route('password.reset-'.session('locale'), [
            'locale' => session('locale'),
            'token' => $token,
            'email' => $email,
        ], false));

        Mail::mailer('smtp_admin')->to($email)->send(new NewPasswordLink($route));

        return true;

        // $this->notify(new BenuResetPasswordNotification($token));
    }
}
