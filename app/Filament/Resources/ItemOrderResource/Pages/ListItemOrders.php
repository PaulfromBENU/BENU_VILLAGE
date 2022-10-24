<?php

namespace App\Filament\Resources\ItemOrderResource\Pages;

use App\Filament\Resources\ItemOrderResource;
use Filament\Resources\Pages\ListRecords;

class ListItemOrders extends ListRecords
{
    protected static string $resource = ItemOrderResource::class;
}
