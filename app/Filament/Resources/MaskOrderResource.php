<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaskOrderResource\Pages;
use App\Filament\Resources\MaskOrderResource\RelationManagers;
use App\Models\Creation;
use App\Models\MaskOrder;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;

class MaskOrderResource extends Resource
{
    protected static ?string $label = 'mask order';
    protected static ?string $pluralLabel = 'mask orders';

    protected static ?string $model = MaskOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationGroup = 'Users';

    protected static ?int $navigationSort = 3;

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
                //     ->label('Creation')
                //     ->required(),
                Forms\Components\TextInput::make('size')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('with_filter')
                    ->required(),
                Forms\Components\Toggle::make('with_cotton')
                    ->required(),
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
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('text_demand'),
                Tables\Columns\TextColumn::make('requested_number')->label('Number of masks requested'),
                Tables\Columns\TextColumn::make('size'),
                Tables\Columns\BooleanColumn::make('with_pictures')->label('Pictures requested?'),
                Tables\Columns\BooleanColumn::make('with_filter')->label('With filter?'),
                Tables\Columns\BooleanColumn::make('with_cotton')->label('Cotton strings?'),
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
            'index' => Pages\ListMaskOrders::route('/'),
            // 'create' => Pages\CreateMaskOrder::route('/create'),
            'edit' => Pages\EditMaskOrder::route('/{record}/edit'),
        ];
    }
}
