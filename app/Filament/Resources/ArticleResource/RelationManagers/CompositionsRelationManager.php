<?php

namespace App\Filament\Resources\ArticleResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

use App\Models\Composition;

class CompositionsRelationManager extends BelongsToManyRelationManager
{
    protected static ?string $label = 'composition';
    protected static ?string $pluralLabel = 'composition';

    protected static string $relationship = 'compositions';

    protected static ?string $recordTitleAttribute = 'fabric_fr';

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
                Tables\Columns\TextColumn::make('fabric_fr'),
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
                static::getAttachFormRecordSelect()->options(Composition::all()->pluck('fabric_fr', 'id'))->searchable(),
                // ...
            ]);
    }
}
