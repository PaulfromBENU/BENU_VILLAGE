<?php

namespace App\Filament\Resources\CreationResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class ArticlesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'articles';

    protected static ?string $recordTitleAttribute = 'name';

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             Forms\Components\TextInput::make('name')
    //                 ->required()
    //                 ->maxLength(255),
    //             Forms\Components\TextInput::make('type')
    //                 ->required()
    //                 ->maxLength(255),
    //             Forms\Components\TextInput::make('size_id'),
    //             Forms\Components\TextInput::make('color_id'),
    //             Forms\Components\TextInput::make('secondary_color')
    //                 ->maxLength(255),
    //             Forms\Components\TextInput::make('third_color')
    //                 ->maxLength(255),
    //             Forms\Components\TextInput::make('mask_stripes')
    //                 ->maxLength(255),
    //             Forms\Components\Toggle::make('mask_filter')
    //                 ->required(),
    //             Forms\Components\TextInput::make('voucher_value')
    //                 ->required()
    //                 ->maxLength(255),
    //             Forms\Components\TextInput::make('voucher_type')
    //                 ->required()
    //                 ->maxLength(255)
    //                 ->default('pdf'),
    //             Forms\Components\Textarea::make('singularity_lu')
    //                 ->required()
    //                 ->maxLength(65535),
    //             Forms\Components\Textarea::make('singularity_fr')
    //                 ->required()
    //                 ->maxLength(65535),
    //             Forms\Components\Textarea::make('singularity_en')
    //                 ->required()
    //                 ->maxLength(65535),
    //             Forms\Components\Textarea::make('singularity_de')
    //                 ->required()
    //                 ->maxLength(65535),
    //             Forms\Components\TextInput::make('translation_key')
    //                 ->required()
    //                 ->maxLength(255)
    //                 ->default('article.singularity-'),
    //             Forms\Components\TextInput::make('creation_date')
    //                 ->required()
    //                 ->maxLength(255)
    //                 ->default('01.01.2021'),
    //             Forms\Components\Toggle::make('is_returned')
    //                 ->required(),
    //             Forms\Components\DatePicker::make('return_date')
    //                 ->required()
    //                 ->default(now()),
    //         ]);
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('size_id'),
                Tables\Columns\TextColumn::make('color_id'),
                Tables\Columns\TextColumn::make('secondary_color'),
                Tables\Columns\TextColumn::make('third_color'),
                Tables\Columns\TextColumn::make('mask_stripes'),
                Tables\Columns\BooleanColumn::make('mask_filter'),
                Tables\Columns\TextColumn::make('voucher_value'),
                Tables\Columns\TextColumn::make('voucher_type'),
                Tables\Columns\TextColumn::make('singularity_lu'),
                Tables\Columns\TextColumn::make('singularity_fr'),
                Tables\Columns\TextColumn::make('singularity_en'),
                Tables\Columns\TextColumn::make('singularity_de'),
                Tables\Columns\TextColumn::make('translation_key'),
                Tables\Columns\TextColumn::make('creation_date'),
                Tables\Columns\BooleanColumn::make('is_returned'),
                Tables\Columns\TextColumn::make('return_date')
                    ->date(),
            ])
            ->filters([
                //
            ]);
    }
}
