<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareRecommendationResource\Pages;
use App\Filament\Resources\CareRecommendationResource\RelationManagers;
use Filament\Forms\Components\Select;
use App\Models\CareRecommendation;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class CareRecommendationResource extends Resource
{
    protected static ?string $label = "care recommendation";
    protected static ?string $pluralLabel = "care recommendations";

    protected static ?string $model = CareRecommendation::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments';

    protected static ?string $navigationGroup = 'Site Data';

    protected static function shouldRegisterNavigation(): bool
    {
        return (auth()->user()->role == 'admin' || auth()->user()->role == 'editor');
    }

    public function mount(): void
    {
        abort_unless((auth()->user()->role == 'admin' || auth()->user()->role == 'editor'), 403);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(255),
                Select::make('family')
                    ->label('Catégorie')
                    ->options([
                        'wash' => "Lavage",
                        'dry' => "Séchage",
                        'iron' => "Repassage"
                    ])
                    ->default('wash'),
                Forms\Components\Textarea::make('description_de')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('description_fr')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('description_en')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('description_lu')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\TextInput::make('translation_key')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('picture')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('family'),
                Tables\Columns\TextColumn::make('description_de'),
                Tables\Columns\TextColumn::make('description_fr'),
                Tables\Columns\TextColumn::make('description_en'),
                Tables\Columns\TextColumn::make('description_lu'),
                Tables\Columns\TextColumn::make('translation_key'),
                Tables\Columns\TextColumn::make('picture'),
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
            'index' => Pages\ListCareRecommendations::route('/'),
            'create' => Pages\CreateCareRecommendation::route('/create'),
            'edit' => Pages\EditCareRecommendation::route('/{record}/edit'),
        ];
    }
}
