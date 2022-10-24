<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopResource\Pages;
use App\Filament\Resources\ShopResource\RelationManagers;
use App\Models\Shop;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;

class ShopResource extends Resource
{
    protected static ?string $label = 'shop';
    protected static ?string $pluralLabel = 'shops';

    protected static ?string $model = Shop::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    protected static ?string $navigationGroup = 'Shops & Partners';

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
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->label('Shop owner')
                    ->options([
                        'BENU owned' => 'BENU Shop',
                        'Pop-up' => 'Pop-up store',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('description_de')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('description_en')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('description_fr')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('description_lu')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('website')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                // Forms\Components\Textarea::make('opening_time')
                //     ->maxLength(65535),
                Forms\Components\TextInput::make('picture')
                    ->maxLength(255),
                Forms\Components\TextInput::make('opening_monday')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('opening_tuesday')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('opening_wednesday')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('opening_thursday')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('opening_friday')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('opening_saturday')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('opening_sunday')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('filter_key')
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
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('description_de')->limit('50'),
                Tables\Columns\TextColumn::make('description_en')->limit('50'),
                Tables\Columns\TextColumn::make('description_fr')->limit('50'),
                Tables\Columns\TextColumn::make('description_lu')->limit('50'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('website'),
                Tables\Columns\TextColumn::make('email'),
                // Tables\Columns\TextColumn::make('opening_time'),
                Tables\Columns\TextColumn::make('picture'),
                Tables\Columns\TextColumn::make('opening_monday'),
                Tables\Columns\TextColumn::make('opening_tuesday'),
                Tables\Columns\TextColumn::make('opening_wednesday'),
                Tables\Columns\TextColumn::make('opening_thursday'),
                Tables\Columns\TextColumn::make('opening_friday'),
                Tables\Columns\TextColumn::make('opening_saturday'),
                Tables\Columns\TextColumn::make('opening_sunday'),
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
            'index' => Pages\ListShops::route('/'),
            'create' => Pages\CreateShop::route('/create'),
            'edit' => Pages\EditShop::route('/{record}/edit'),
        ];
    }
}
