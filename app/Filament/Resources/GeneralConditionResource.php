<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GeneralConditionResource\Pages;
use App\Filament\Resources\GeneralConditionResource\RelationManagers;
use App\Models\GeneralCondition;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Hidden;

class GeneralConditionResource extends Resource
{
    protected static ?string $label = 'general conditions';
    protected static ?string $pluralLabel = 'general conditions';

    protected static ?string $model = GeneralCondition::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Site Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('content_lu')
                    ->default(auth()->user()->email.' - '.date("d/m/Y"))
                    ->nullable(),
                Hidden::make('content_fr')
                    ->default(auth()->user()->email.' - '.date("d/m/Y"))
                    ->nullable(),
                Hidden::make('content_de')
                    ->default(auth()->user()->email.' - '.date("d/m/Y"))
                    ->nullable(),
                Hidden::make('content_en')
                    ->default(auth()->user()->email.' - '.date("d/m/Y"))
                    ->nullable(),
                // Forms\Components\TextInput::make('content_lu')
                //     ->default(auth()->user()->email.' - '.date("d/m/Y"))
                //     ->nullable()
                //     ->hidden()
                //     ->maxLength(65535),
                // Forms\Components\TextInput::make('content_fr')
                //     ->default(auth()->user()->email.' - '.date("d/m/Y"))
                //     ->nullable()
                //     ->hidden()
                //     ->maxLength(65535),
                // Forms\Components\TextInput::make('content_de')
                //     ->default(auth()->user()->email.' - '.date("d/m/Y"))
                //     ->nullable()
                //     ->hidden()
                //     ->maxLength(65535),
                // Forms\Components\TextInput::make('content_en')
                //     ->default(auth()->user()->email.' - '.date("d/m/Y"))
                //     ->nullable()
                //     ->hidden()
                //     ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('content_lu')->label('General Conditions LU')->limit(50),
                Tables\Columns\TextColumn::make('content_en')->label('General Conditions EN')->limit(50),
                Tables\Columns\TextColumn::make('content_de')->label('General Conditions DE')->limit(50),
                Tables\Columns\TextColumn::make('content_fr')->label('General Conditions FR')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->label('Publication Date')
                    ->dateTime(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGeneralConditions::route('/'),
            'create' => Pages\CreateGeneralCondition::route('/create'),
            'edit' => Pages\EditGeneralCondition::route('/{record}/edit'),
        ];
    }
}
