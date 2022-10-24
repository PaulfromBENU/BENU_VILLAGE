<?php

namespace App\Filament\Resources\ArticleResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

use App\Models\CareRecommendation;

class CareRecommendationsRelationManager extends BelongsToManyRelationManager
{
    protected static ?string $label = 'entretien';
    protected static ?string $pluralLabel = 'entretien';

    protected static string $relationship = 'care_recommendations';

    protected static ?string $recordTitleAttribute = 'name';

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             //
    //         ]);
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('description_fr')->limit(50),
            ])
            ->filters([
                //
            ]);
    }

    public static function attachForm(Form $form): Form
    {
        return $form
            ->schema([
                static::getAttachFormRecordSelect()->options(CareRecommendation::all()->pluck('name', 'id'))->searchable(),
                // ...
            ]);
    }
}
