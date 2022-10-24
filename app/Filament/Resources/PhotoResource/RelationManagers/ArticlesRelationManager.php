<?php

namespace App\Filament\Resources\PhotoResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

use App\Models\Article;

class ArticlesRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'articles';

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
                Tables\Columns\TextColumn::make('creation.name'),
                Tables\Columns\TextColumn::make('color.name'),
                Tables\Columns\TextColumn::make('size.value'),
            ])
            ->filters([
                //
            ]);
    }

    public static function attachForm(Form $form): Form
    {
        return $form
            ->schema([
                static::getAttachFormRecordSelect()->options(Article::all()->pluck('name', 'id'))->searchable(),
                // ...
            ]);
    }
}
