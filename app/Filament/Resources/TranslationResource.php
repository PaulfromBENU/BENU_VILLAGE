<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TranslationResource\Pages;
use App\Filament\Resources\TranslationResource\RelationManagers;
use App\Models\Translation;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Closure;
use Filament\Forms\Components\Hidden;

class TranslationResource extends Resource
{
    protected static ?string $label = 'translation';
    protected static ?string $pluralLabel = 'translations';

    protected static ?string $model = Translation::class;

    protected static ?string $navigationIcon = 'heroicon-o-translate';

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
                // Select::make('page')
                //     ->label('Translation group')
                //     ->options([
                //         'about' => 'about',
                //         'auth' => 'auth',
                //         'breadcrumbs' => 'breadcrumbs',
                //         'campaigns' => 'campaigns',
                //         'cart' => 'cart',
                //         'colors' => 'colors',
                //         'components' => 'components',
                //         'contact' => 'contact',
                //         'dashboard' => 'dashboard',
                //         'emails' => 'emails',
                //         'footer' => 'footer',
                //         'forms' => 'forms',
                //         'header' => 'header',
                //         'models' => 'models',
                //         'news' => 'news',
                //         'pagination' => 'pagination',
                //         'paricipate' => 'participate',
                //         'partners' => 'partners',
                //         'passwords' => 'passwords',
                //         'payment' => 'payment',
                //         'pdf' => 'pdf',
                //         'services' => 'services',
                //         'sidebar' => 'sidebar',
                //         'slugs' => 'slugs',
                //         'sold' => 'sold',
                //         'vouchers' => 'vouchers',
                //         'welcome' => 'welcome',
                //     ])
                //     ->hidden()
                //     ->required(),
                Hidden::make('page')
                    ->required(),
                Hidden::make('key')
                    ->required(),
                Forms\Components\TextInput::make('translation_key')
                    ->maxLength(255)
                    ->columnSpan(2)
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $set('page', explode('.', $state)[0]);
                        if(count(explode('.', $state)) > 1) {
                            $set('key', explode('.', $state)[1]);
                        }
                    })
                    ->required(),
                Forms\Components\Textarea::make('fr')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('en')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('de')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('lu')
                    ->required()
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('page')->sortable()->searchable(),
                // Tables\Columns\TextColumn::make('key')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('translation_key')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('de')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('fr')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('en')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('lu')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListTranslations::route('/'),
            'create' => Pages\CreateTranslation::route('/create'),
            'edit' => Pages\EditTranslation::route('/{record}/edit'),
        ];
    }
}
