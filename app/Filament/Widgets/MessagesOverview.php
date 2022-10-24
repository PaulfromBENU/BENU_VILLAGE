<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

use Carbon\Carbon;

use App\Models\ContactMessage;
use App\Models\ItemOrder;
use App\Models\MaskOrder;

class MessagesOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';

    protected function getHeader(): string
    {
        return 'Messages et Demandes';
    }

    protected function getCards(): array
    {
        return [
            Card::make('Unanswered user messages', ContactMessage::where('is_answered', '0')->where('closed', '0')->count())
            ->color('success'),
            Card::make('Mask orders', MaskOrder::where('is_read', '0')->count())
            ->color('success'),
            Card::make("Small articles orders", ItemOrder::where('is_read', '0')->count())
            ->color('success'),
        ];
    }
}
