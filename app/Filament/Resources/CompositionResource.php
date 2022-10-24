<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompositionResource\Pages;
use App\Filament\Resources\CompositionResource\RelationManagers;
use App\Models\Composition;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class CompositionResource extends Resource
{
    protected static ?string $label = 'variation composition';
    protected static ?string $pluralLabel = 'variation composition';

    protected static ?string $model = Composition::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

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
                Forms\Components\TextInput::make('fabric_lu')
                    ->maxLength(255),
                Forms\Components\TextInput::make('fabric_en')
                    ->maxLength(255),
                Forms\Components\TextInput::make('fabric_de')
                    ->maxLength(255),
                Forms\Components\TextInput::make('fabric_fr')
                    ->maxLength(255),
                Forms\Components\TextInput::make('translation_key_fabric')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('explanation_fr')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('explanation_lu')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('explanation_de')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('explanation_en')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\TextInput::make('translation_key_explanation')
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
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime(),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime(),
                Tables\Columns\TextColumn::make('fabric_lu'),
                Tables\Columns\TextColumn::make('fabric_en'),
                Tables\Columns\TextColumn::make('fabric_de'),
                Tables\Columns\TextColumn::make('fabric_fr'),
                Tables\Columns\TextColumn::make('translation_key_fabric'),
                Tables\Columns\TextColumn::make('explanation_fr'),
                Tables\Columns\TextColumn::make('explanation_lu'),
                Tables\Columns\TextColumn::make('explanation_de'),
                Tables\Columns\TextColumn::make('explanation_en'),
                Tables\Columns\TextColumn::make('translation_key_explanation'),
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
            'index' => Pages\ListCompositions::route('/'),
            'create' => Pages\CreateComposition::route('/create'),
            'edit' => Pages\EditComposition::route('/{record}/edit'),
        ];
    }
}
