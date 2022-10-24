<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoucherResource\Pages;
use App\Filament\Resources\VoucherResource\RelationManagers;
use App\Filament\Resources\Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Voucher;

use App\Traits\VoucherGenerator;

class VoucherResource extends Resource
{       
    protected static ?string $model = Voucher::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-tax';

    protected static ?string $navigationGroup = 'Seller & Sales';

    protected static ?int $navigationSort = 4;

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role == 'admin';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('initial_value')
                    ->options([30 => '30', 60 => '60', 90 => '90', 120 => '120', 150 => '150', 180 => '180'])
                // Forms\Components\TextInput::make('initial_value')
                    ->reactive()
                    ->afterStateUpdated(function($set, $state) {
                        // $voucher_count = str_pad(Voucher::where('unique_code', 'LIKE', '%'.date('m').substr(date('Y').'%', 2, 2))->count() + 1, 2, '0', STR_PAD_LEFT);
                        // $value_code = str_pad(substr($state / 10, 0, 2), 2, '0', STR_PAD_LEFT);
                        // // $value_code = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
                        // $new_code = strtoupper("BC".date('m').substr(date('Y'), 2, 2).$voucher_count.$value_code.str_shuffle(Str::random(1).rand(0, 9)));
                        // while (Voucher::where('unique_code', $new_code)->count() > 0) {
                        //     $increment = rand(0, 9).rand(0, 9);
                        //     $value_code = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
                        //     $new_code = strtoupper("BC".date('m').substr(date('Y'), 2, 2).$voucher_count.$value_code.str_shuffle(Str::random(1).rand(0, 9)));
                        // }
                        $new_code = VoucherGenerator::generateVoucherCode($state);
                        $set('unique_code', $new_code);
                        $set('remaining_value', $state);
                    })
                    ->required(),
                Forms\Components\TextInput::make('remaining_value')
                    ->required(),
                Select::make('user_id')
                    ->label('User e-mail (optionnal)')
                    ->options(User::all()->pluck('email', 'id'))
                    ->searchable(),
                Forms\Components\DateTimePicker::make('expires_on')->hidden(),
                Forms\Components\TextInput::make('unique_code')
                    ->required()
                    ->maxLength(12)
                    ->default(function(callable $get) {
                        // $voucher_count = str_pad(Voucher::where('unique_code', 'LIKE', '%'.date('m').substr(date('Y').'%', 2, 2))->count() + 1, 2, '0', STR_PAD_LEFT);
                        // $value_code = '00';
                        // // $value_code = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
                        // $new_code = strtoupper("BC".date('m').substr(date('Y'), 2, 2).$voucher_count.$value_code.str_shuffle(Str::random(1).rand(0, 9)));
                        // while (Voucher::where('unique_code', $new_code)->count() > 0) {
                        //     $increment = rand(0, 9).rand(0, 9);
                        //     $value_code = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
                        //     $new_code = strtoupper("BC".date('m').substr(date('Y'), 2, 2).$voucher_count.$value_code.str_shuffle(Str::random(1).rand(0, 9)));
                        // }
                        // return $new_code;
                        return VoucherGenerator::generateVoucherCode('00');
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('unique_code'),
                Tables\Columns\TextColumn::make('initial_value')->money('eur'),
                Tables\Columns\TextColumn::make('remaining_value')->money('eur'),
                Tables\Columns\TextColumn::make('user.email')->label('User email'),
                Tables\Columns\TextColumn::make('user.last_name')->label('User name'),
                Tables\Columns\TextColumn::make('expires_on')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
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
            'index' => Pages\ListVouchers::route('/'),
            'create' => Pages\CreateVoucher::route('/create'),
            'edit' => Pages\EditVoucher::route('/{record}/edit'),
        ];
    }
}
