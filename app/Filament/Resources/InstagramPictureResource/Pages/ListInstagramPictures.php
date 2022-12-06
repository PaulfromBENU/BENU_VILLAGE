<?php

namespace App\Filament\Resources\InstagramPictureResource\Pages;

use App\Filament\Resources\InstagramPictureResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInstagramPictures extends ListRecords
{
    protected static string $resource = InstagramPictureResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
