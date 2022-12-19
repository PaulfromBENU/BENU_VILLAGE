<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstagramPictureResource\Pages;
use App\Filament\Resources\InstagramPictureResource\RelationManagers;
use App\Models\InstagramPicture;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;

class InstagramPictureResource extends Resource
{
    protected static ?string $model = InstagramPicture::class;

    protected static ?string $navigationIcon = 'heroicon-o-photograph';

    protected static ?string $title = 'Add a new Instagram Picture';
 
    protected static ?string $navigationLabel = 'Instagram Feed';
     
    protected static ?string $slug = 'add-instagram-picture';

    protected static ?string $navigationGroup = 'News and Medias';

    protected static ?int $navigationSort = 3;

    protected static function shouldRegisterNavigation(): bool
    {
        $authorized_roles = [
            'admin',
            'assistant',
            'vendor',
            'photo-upload',
        ];
        return in_array(auth()->user()->role, $authorized_roles);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('post_link')
                    ->label('Instagram Post link')
                    ->placeholder('https://www.instagram.com/p/...')
                    ->required()
                    ->maxLength(100)
                    ->helperText('Copy here full link from Instagram, including https://'),
                FileUpload::make('picture_name')
                        ->label('Picture upload')
                        ->disk('public_folder')
                        ->directory('media/pictures/instagram')
                        ->visibility('public')
                        ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/bmp'])
                        ->preserveFilenames()
                        ->maxSize(1024)
                        ->helperText('Picture should be square, and size sould be below 1Mo'),
                Forms\Components\Toggle::make('is_couture')
                    ->label('Display on COUTURE')
                    ->hidden()
                    ->required(),
                Forms\Components\Toggle::make('is_village')
                    ->label('Display on VILLAGE')
                    ->default('1')
                    ->disabled()
                    ->required(),
                Forms\Components\Toggle::make('is_sloow')
                    ->label('Display on SLOOW')
                    ->hidden()
                    ->required(),
                Forms\Components\Toggle::make('is_form')
                    ->label('Display on FORM')
                    ->hidden()
                    ->required(),
                Forms\Components\Toggle::make('is_reuse')
                    ->label('Display on REUSE')
                    ->hidden()
                    ->required(),
                Forms\Components\Toggle::make('is_break')
                    ->label('Display on BREAK')
                    ->hidden()
                    ->required(),
                Forms\Components\Toggle::make('is_lasa')
                    ->label('Display on LaSA')
                    ->hidden()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('post_link')
                ->label('Instagram Post'),
                Tables\Columns\TextColumn::make('picture_name'),
                Tables\Columns\IconColumn::make('is_couture')
                    ->boolean()
                    ->label('Display on COUTURE'),
                Tables\Columns\IconColumn::make('is_village')
                    ->boolean()
                    ->label('Display on VILLAGE'),
                Tables\Columns\IconColumn::make('is_sloow')
                    ->boolean()
                    ->label('Display on SLOOW'),
                Tables\Columns\IconColumn::make('is_form')
                    ->boolean()
                    ->label('Display on FORM'),
                Tables\Columns\IconColumn::make('is_reuse')
                    ->boolean()
                    ->label('Display on REUSE'),
                Tables\Columns\IconColumn::make('is_break')
                    ->boolean()
                    ->label('Display on BREAK'),
                Tables\Columns\IconColumn::make('is_lasa')
                    ->boolean()
                    ->label('Display on LaSA'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListInstagramPictures::route('/'),
            'create' => Pages\CreateInstagramPicture::route('/create'),
            'edit' => Pages\EditInstagramPicture::route('/{record}/edit'),
        ];
    }    
}
