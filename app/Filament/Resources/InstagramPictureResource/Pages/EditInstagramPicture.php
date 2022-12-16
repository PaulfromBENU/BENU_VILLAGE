<?php

namespace App\Filament\Resources\InstagramPictureResource\Pages;

use App\Filament\Resources\InstagramPictureResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInstagramPicture extends EditRecord
{
    protected static string $resource = InstagramPictureResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
