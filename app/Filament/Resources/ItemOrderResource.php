<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemOrderResource\Pages;
use App\Filament\Resources\ItemOrderResource\RelationManagers;
use Filament\Navigation\NavigationItem;
use App\Models\Creation;
use App\Models\ItemOrder;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;

class ItemOrderResource extends Resource
{
    protected static ?string $label = 'small items order';
    protected static ?string $pluralLabel = 'small items orders';

    protected static ?string $model = ItemOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-color-swatch';

    protected static ?string $navigationGroup = 'Users';

    protected static ?int $navigationSort = 4;

    // protected static function getNavigationBadge(): ?string
    // {
    //     return ItemOrder::where('is_read', '0')->count();
    // }

    // public static function getNavigationItems(): array
    // {
    //     return [
    //         NavigationItem::make()
    //             ->badge($badge),
    //     ];
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('creation_id')
                    ->label('Creation')
                    ->options(Creation::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                // Forms\Components\TextInput::make('creation_id')
                //     ->required(),
                Forms\Components\TextInput::make('requested_number')
                    ->required(),
                Forms\Components\Textarea::make('text_demand')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('with_pictures')
                    ->label('Pictures requested')
                    ->required(),
                Forms\Components\Toggle::make('is_read')
                    ->label('Mark as read')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BooleanColumn::make('is_read')->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('creation.name')->label('Creation')->searchable(),
                Tables\Columns\TextColumn::make('requested_number')->label('Number of items requested'),
                Tables\Columns\TextColumn::make('text_demand'),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\BooleanColumn::make('with_pictures')->label('Pictures requested?'),
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
            'index' => Pages\ListItemOrders::route('/'),
            // 'create' => Pages\CreateItemOrder::route('/create'),
            'edit' => Pages\EditItemOrder::route('/{record}/edit'),
        ];
    }
}
