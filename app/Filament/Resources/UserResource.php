<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Tables;

class UserResource extends Resource
{
    protected static ?string $label = 'users list';
    protected static ?string $pluralLabel = 'users list';

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Users';

    protected static ?int $navigationSort = 5;

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role == 'admin';
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->role == 'admin', 403);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                // Forms\Components\TextInput::make('password')
                //     ->password()
                //     ->required()
                //     ->minLength(8)
                //     ->maxLength(255)
                //     ->hiddenOn(Pages\EditUser::class),
                Select::make('role')
                    ->label('Role')
                    ->options([
                        'admin' => 'Administrator (full rights)',
                        'vendor' => 'Shop vendor',
                        'author' => 'Content Editor',
                        'standard' => 'Basic user',
                        'newsletter' => 'Newsletter subscriber',
                        'guest_client' => 'Simple guest',
                    ]),
                Forms\Components\TextInput::make('first_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('gender')
                    ->maxLength(255),
                Forms\Components\TextInput::make('company')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_over_18')
                    ->required(),
                Forms\Components\Toggle::make('legal_ok')
                    ->required(),
                Forms\Components\Toggle::make('last_conditions_agreed')
                    ->required(),
                Forms\Components\Toggle::make('newsletter')
                    ->required(),
                Forms\Components\TextInput::make('origin')
                    ->maxLength(255),
                Forms\Components\TextInput::make('badge')
                    ->default('standard')
                    ->maxLength(255),
                Forms\Components\TextInput::make('client_number')
                    ->required()
                    ->maxLength(255),
                Select::make('favorite_language')
                    ->label('Default language')
                    ->options([
                        'en' => 'English',
                        'lu' => 'Luxemburgish',
                        'de' => 'German',
                        'fr' => 'French',
                    ]),
                Forms\Components\TextInput::make('rating')
                    ->label('Rating # / 10')
                    ->default('10')
                    ->maxLength(255),
                Forms\Components\Textarea::make('general_comment')
                    ->default('No comment')
                    ->maxLength(65535),
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
                Tables\Columns\TextColumn::make('last_login')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('role'),
                Tables\Columns\TextColumn::make('first_name'),
                Tables\Columns\TextColumn::make('last_name'),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('company'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\BooleanColumn::make('is_over_18'),
                Tables\Columns\BooleanColumn::make('legal_ok'),
                Tables\Columns\BooleanColumn::make('last_conditions_agreed'),
                Tables\Columns\BooleanColumn::make('newsletter'),
                Tables\Columns\TextColumn::make('origin'),
                Tables\Columns\TextColumn::make('badge'),
                Tables\Columns\TextColumn::make('client_number'),
                Tables\Columns\TextColumn::make('favorite_language'),
                Tables\Columns\TextColumn::make('rating'),
                Tables\Columns\TextColumn::make('general_comment'),
                Tables\Columns\TextColumn::make('stripe_id'),
                Tables\Columns\TextColumn::make('pm_type'),
                Tables\Columns\TextColumn::make('pm_last_four'),
                Tables\Columns\TextColumn::make('trial_ends_at')
                    ->dateTime(),
                Tables\Columns\BooleanColumn::make('delete_confirmation'),
                Tables\Columns\TextColumn::make('delete_feedback'),
                Tables\Columns\TextColumn::make('deleted_at')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
