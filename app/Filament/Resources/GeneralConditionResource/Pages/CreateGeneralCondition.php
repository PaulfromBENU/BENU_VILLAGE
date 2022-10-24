<?php

namespace App\Filament\Resources\GeneralConditionResource\Pages;

use App\Filament\Resources\GeneralConditionResource;
use Filament\Resources\Pages\CreateRecord;

use App\Models\User;

use App\Jobs\SendUpdatedConditionsEmail;

class CreateGeneralCondition extends CreateRecord
{
    protected static string $resource = GeneralConditionResource::class;

    protected function afterValidate(): void
    {
        // $this->resource->content_lu = auth()->user()->email.' - '.date("d/m/Y");
        // $this->resource->content_de = auth()->user()->email.' - '.date("d/m/Y");
        // $this->resource->content_en = auth()->user()->email.' - '.date("d/m/Y");
        // $this->resource->content_fr = auth()->user()->email.' - '.date("d/m/Y");

        // $this->resource->save();

        User::where('last_conditions_agreed', '1')->update([
            'last_conditions_agreed' => '0',
        ]);

        SendUpdatedConditionsEmail::dispatchAfterResponse();
    }
}
