<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

use Carbon\Carbon;

use App\Models\Article;
use App\Models\Cart;
use App\Models\ContactMessage;
use App\Models\Shop;
use App\Models\Translation;
use App\Models\User;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';

    protected function getCards(): array
    {
        $number_of_days = 7;

        // Static data evaluation
        $last_users_count = [];
        $newsletter_registered_count = [];

        for ($i=$number_of_days; $i >= 0; $i--) { 
            array_push($last_users_count, User::where('created_at', '<', Carbon::now()->subDays($i))->count());
            array_push($newsletter_registered_count, User::where('newsletter', '2')->where('updated_at', '<', Carbon::now()->subDays($i))->count());
        }

        // Trends evaluation
        // Total users
        $users_last_period = User::where('created_at', '>', Carbon::now()->subDays($number_of_days))->where('created_at', '<=', Carbon::now())->count();
        $users_previous_period = User::where('created_at', '>', Carbon::now()->subDays($number_of_days * 2))->where('created_at', '<=', Carbon::now()->subDays($number_of_days))->count();
        $users_delta = $users_last_period - $users_previous_period;
        if ($users_delta < 0) {
            $users_icon = 'heroicon-s-trending-down';
            $user_color = 'danger';
        } elseif ($users_delta > 0) {
            $users_icon = 'heroicon-s-trending-up';
            $user_color = 'success';
        } else {
            $users_icon = 'heroicon-s-arrow-narrow-right';
            $user_color = 'warning';
        }

        // Total users registered to the newsletter
        $newsletter_last_period = User::where('newsletter', '2')->where('updated_at', '>', Carbon::now()->subDays($number_of_days))->where('updated_at', '<=', Carbon::now())->count();
        $newsletter_previous_period = User::where('newsletter', '2')->where('updated_at', '>', Carbon::now()->subDays($number_of_days * 2))->where('updated_at', '<=', Carbon::now()->subDays($number_of_days))->count();
        $newsletter_delta = $newsletter_last_period - $newsletter_previous_period;
        if ($newsletter_delta < 0) {
            $newsletter_icon = 'heroicon-s-trending-down';
            $newsletter_color = 'danger';
        } elseif ($newsletter_delta > 0) {
            $newsletter_icon = 'heroicon-s-trending-up';
            $newsletter_color = 'success';
        } else {
            $newsletter_icon = 'heroicon-s-arrow-narrow-right';
            $newsletter_color = 'warning';
        }

        return [
            Card::make('Number of users registered', User::count())
            ->description('Over 8 days')
            ->descriptionIcon($users_icon)
            ->chart($last_users_count)
            ->color($user_color),
            Card::make('Users registered to the newsletter', User::where('newsletter', '2')->count())
            ->description('Over 8 days')
            ->descriptionIcon($newsletter_icon)
            ->chart($newsletter_registered_count)
            ->color($newsletter_color),
            Card::make('Newsletter requests pending', User::where('newsletter', '1')->count()),
            Card::make('Unanswered user messages', ContactMessage::where('is_answered', '0')->where('closed', '0')->count())
            ->color('success'),
        ];
    }
}
