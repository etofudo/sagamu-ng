<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaystackTransactionResource\Pages;
use App\Models\PaystackTransaction;
use App\Services\PaystackService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PaystackTransactionResource extends Resource
{
    protected static ?string $model = PaystackTransaction::class;

    protected static ?string $navigationIcon  = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Payments';
    protected static ?int    $navigationSort  = 5;

    // No create — payments come from the public site only
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Transaction')->schema([
                Forms\Components\TextInput::make('reference')->disabled(),
                Forms\Components\TextInput::make('type')->disabled(),
                Forms\Components\TextInput::make('email')->disabled(),
                Forms\Components\TextInput::make('amount_kobo')
                    ->label('Amount (kobo)')
                    ->helperText('Divide by 100 to get naira. e.g. 500000 = ₦5,000')
                    ->disabled(),
                Forms\Components\TextInput::make('status')->disabled(),
                Forms\Components\DateTimePicker::make('paid_at')->disabled(),
                Forms\Components\TextInput::make('gateway_response')->disabled(),
            ])->columns(2),

            // Manual override — only for admin reconciliation when something went wrong
            Forms\Components\Section::make('Manual Override')
                ->description('Only use this if Paystack confirmed payment but our system missed the callback.')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'success' => 'Success',
                            'failed'  => 'Failed',
                        ]),
                    Forms\Components\Toggle::make('listing.is_featured')
                        ->label('Mark listing as featured')
                        ->disabled(),
                ])
                ->collapsed(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')
                    ->searchable()
                    ->limit(24)
                    ->copyable(),

                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn(string $state) => match($state) {
                        'featured_listing' => 'warning',
                        'donation'         => 'success',
                        default            => 'gray',
                    }),

                Tables\Columns\TextColumn::make('listing.name')
                    ->label('Listing')
                    ->limit(25)
                    ->default('—'),

                Tables\Columns\TextColumn::make('email')->limit(25)->searchable(),

                // Display formatted — computed from integer kobo, no float
                Tables\Columns\TextColumn::make('amount_kobo')
                    ->label('Amount')
                    ->formatStateUsing(fn(int $state) => PaystackService::formatKobo($state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state) => match($state) {
                        'success' => 'success',
                        'pending' => 'warning',
                        'failed'  => 'danger',
                    }),

                Tables\Columns\TextColumn::make('paid_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->default('—'),

                Tables\Columns\TextColumn::make('created_at')->since()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['pending' => 'Pending', 'success' => 'Success', 'failed' => 'Failed']),
                Tables\Filters\SelectFilter::make('type')
                    ->options(['featured_listing' => 'Featured Listing', 'donation' => 'Donation']),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaystackTransactions::route('/'),
            'view'  => Pages\ViewPaystackTransaction::route('/{record}'),
        ];
    }
}
