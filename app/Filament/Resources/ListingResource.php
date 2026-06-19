<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListingResource\Pages;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Neighbourhood;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Basic Info')->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(200)
                    ->columnSpanFull(),

                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->options(Category::active()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('neighbourhood_id')
                    ->label('Neighbourhood')
                    ->options(Neighbourhood::orderBy('name')->pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
            ])->columns(2),

            Forms\Components\Section::make('Description & Location')->schema([
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('address')
                    ->maxLength(300)
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Contact')->schema([
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(30),

                Forms\Components\TextInput::make('whatsapp')
                    ->label('WhatsApp')
                    ->tel()
                    ->maxLength(30),

                Forms\Components\TextInput::make('opening_hours')
                    ->placeholder('e.g. Mon–Sat 8am–10pm')
                    ->maxLength(100),

                Forms\Components\TextInput::make('website')
                    ->url()
                    ->maxLength(300),
            ])->columns(2),

            Forms\Components\Section::make('Media')->schema([
                Forms\Components\FileUpload::make('hero_image')
                    ->image()
                    ->directory('listings')
                    ->maxSize(3072),

                Forms\Components\Repeater::make('gallery')
                    ->schema([
                        Forms\Components\FileUpload::make('url')
                            ->label('Image')
                            ->image()
                            ->directory('listings/gallery')
                            ->maxSize(3072),
                    ])
                    ->maxItems(6)
                    ->collapsible(),
            ])->columns(2),

            Forms\Components\Section::make('Publishing')->schema([
                Forms\Components\Select::make('price_range')
                    ->options([
                        'budget'  => '₦ Budget',
                        'mid'     => '₦₦ Mid-range',
                        'premium' => '₦₦₦ Premium',
                        'na'      => 'Not applicable',
                    ])
                    ->nullable(),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending'  => 'Pending',
                        'active'   => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->default('pending')
                    ->required(),

                Forms\Components\Toggle::make('is_featured')->default(false),
                Forms\Components\Toggle::make('is_published')->default(false),
            ])->columns(2),

            Forms\Components\Section::make('Submitter (not published)')->schema([
                Forms\Components\TextInput::make('contact_name')->maxLength(100),
                Forms\Components\TextInput::make('contact_email')->email()->maxLength(200),
            ])->columns(2)->collapsed(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()->limit(35),
                Tables\Columns\TextColumn::make('category.name')->sortable()->badge(),
                Tables\Columns\TextColumn::make('neighbourhood.name')->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        'active'   => 'success',
                        'pending'  => 'warning',
                        'inactive' => 'danger',
                    }),
                Tables\Columns\IconColumn::make('is_featured')->boolean()->label('Featured'),
                Tables\Columns\IconColumn::make('is_published')->boolean()->label('Live'),
                Tables\Columns\TextColumn::make('created_at')->since()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['pending' => 'Pending', 'active' => 'Active', 'inactive' => 'Inactive']),
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('neighbourhood')
                    ->relationship('neighbourhood', 'name'),
                Tables\Filters\TernaryFilter::make('is_published')->label('Published'),
                Tables\Filters\TernaryFilter::make('is_featured')->label('Featured'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListListings::route('/'),
            'create' => Pages\CreateListing::route('/create'),
            'edit'   => Pages\EditListing::route('/{record}/edit'),
        ];
    }
}
