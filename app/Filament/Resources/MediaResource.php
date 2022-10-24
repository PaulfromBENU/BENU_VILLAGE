<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Filament\Resources\MediaResource\RelationManagers;
use App\Models\Media;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $title = 'Add a new Media';
 
    protected static ?string $navigationLabel = 'Medias';
     
    protected static ?string $slug = 'add-media';

    protected static ?string $navigationGroup = 'News and Medias';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('family')
                    ->label('Publication type')
                    ->options([
                        'newspapers' => 'Newspaper',
                        'radio' => 'Radio',
                        'video' => 'Video',
                        'web' => 'Internet',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Select::make('language')
                    ->label('Publication language')
                    ->options([
                        'en' => 'English',
                        'lu' => 'Luxemburgish',
                        'de' => 'German',
                        'fr' => 'French',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('editor')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('publication_date'),
                // Forms\Components\TextInput::make('doc_name')
                //     ->maxLength(255),
                Forms\Components\TextInput::make('link')
                    ->maxLength(255),
                FileUpload::make('doc_name')
                        ->label('Document upload')
                        ->disk('public_folder')
                        ->directory('medias')
                        ->visibility('public')
                        ->acceptedFileTypes(['application/pdf', 'application/PDF', 'image/png', 'image/jpg', 'image/jpeg'])
                        // ->minSize(10)
                        ->maxSize(15000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('family'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('editor'),
                Tables\Columns\TextColumn::make('language'),
                Tables\Columns\TextColumn::make('publication_date')
                    ->date(),
                Tables\Columns\TextColumn::make('doc_name'),
                Tables\Columns\TextColumn::make('link'),
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
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}
