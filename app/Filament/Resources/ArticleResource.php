<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

use App\Models\Color;
use App\Models\Creation;
use App\Models\Size;
use Filament\Forms\Components\Select;

class ArticleResource extends Resource
{
    protected static ?string $label = 'variation';
    protected static ?string $pluralLabel = 'variations';

    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Creations & Variations';

    protected static ?int $navigationSort = 2;

    protected static function shouldRegisterNavigation(): bool
    {
        return (auth()->user()->role == 'hidden');
        // return (auth()->user()->role == 'admin' || auth()->user()->role == 'editor');
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
                Forms\Components\Toggle::make('checked')
                    ->required()
                    ->default('0'),
                Select::make('creation_id')
                        ->label('Creation')
                        ->options(Creation::all()->pluck('name', 'id'))
                        ->searchable(),
                Select::make('size_id')
                        ->label('Size')
                        ->options(Size::all()->pluck('value', 'id'))
                        ->searchable(),
                //Forms\Components\TextInput::make('size_id'),
                Select::make('color_id')
                        ->label('Color')
                        ->options(Color::all()->pluck('name', 'id'))
                        ->searchable(),
                //Forms\Components\TextInput::make('color_id'),
                Select::make('voucher_type')
                    ->required()
                    ->options(['pdf', 'fabric'])
                    ->default('pdf')
                    ->disablePlaceholderSelection(),
                Forms\Components\Toggle::make('mask_filter')
                    ->label('Mask with filter?')
                    ->required(),
                Forms\Components\TextInput::make('mask_stripes')
                    ->label('Mask with cotton stripes?')
                    ->maxLength(255),
                Forms\Components\Textarea::make('singularity_lu')
                    ->maxLength(2000),
                Forms\Components\Textarea::make('singularity_fr')
                    ->maxLength(2000),
                Forms\Components\Textarea::make('singularity_en')
                    ->maxLength(2000),
                Forms\Components\Textarea::make('singularity_de')
                    ->maxLength(2000),
                Forms\Components\TextInput::make('translation_key')
                    ->maxLength(255),
                Forms\Components\TextInput::make('creation_date')
                    ->required()
                    ->maxLength(255)
                    ->default('01.01.2021'),
                Forms\Components\Toggle::make('is_extra_accessory')
                    ->required(),
                // Forms\Components\Toggle::make('is_returned')
                //     ->required(),
                // Forms\Components\DatePicker::make('return_date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\BooleanColumn::make('checked')->sortable()->label('Visible'),
                Tables\Columns\BooleanColumn::make('is_extra_accessory')->sortable()->label('Interchangeable element'),
                Tables\Columns\TextColumn::make('creation.name')->label('Creation')->sortable(),
                Tables\Columns\TextColumn::make('size.value')->label('Size')->sortable(),
                Tables\Columns\TextColumn::make('color.name')->label('Color')->sortable(),
                // Tables\Columns\TextColumn::make('secondary_color'),
                // Tables\Columns\TextColumn::make('third_color'),
                Tables\Columns\TextColumn::make('mask_stripes'),
                Tables\Columns\BooleanColumn::make('mask_filter'),
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

    public static function getRelations(): array
    {
        return [
            // RelationManagers\ShopsRelationManager::class,
            // RelationManagers\CompositionsRelationManager::class,
            // RelationManagers\CareRecommendationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
