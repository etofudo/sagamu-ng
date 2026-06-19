<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NeighbourhoodResource\Pages;
use App\Models\Neighbourhood;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NeighbourhoodResource extends Resource
{
    protected static ?string $model = Neighbourhood::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Identity')->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(100)
                    ->live(onBlur: true),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(100),

                Forms\Components\TextInput::make('character')
                    ->placeholder('e.g. Commercial hub, expressway access')
                    ->maxLength(200),
            ])->columns(3),

            Forms\Components\Section::make('At a Glance')->schema([
                Forms\Components\TextInput::make('rental_range')
                    ->placeholder('e.g. ₦500k–₦1.2m/yr')
                    ->maxLength(100),

                Forms\Components\TextInput::make('best_for')
                    ->placeholder('e.g. Professionals, Lagos commuters')
                    ->maxLength(150),

                Forms\Components\TextInput::make('nearest_landmark')
                    ->maxLength(150),

                Forms\Components\TextInput::make('transport_info')
                    ->maxLength(200),
            ])->columns(2),

            Forms\Components\Section::make('Content')->schema([
                Forms\Components\RichEditor::make('description')
                    ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'orderedList', 'h2', 'h3'])
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('hero_image')
                    ->image()
                    ->directory('neighbourhoods')
                    ->maxSize(3072)
                    ->columnSpanFull(),
            ]),

            Forms\Components\Toggle::make('is_published')->default(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\IconColumn::make('is_published')->boolean()->label('Published'),
                Tables\Columns\TextColumn::make('listings_count')
                    ->counts('listings')
                    ->label('Listings'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->since(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published'),
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
            'index'  => Pages\ListNeighbourhoods::route('/'),
            'create' => Pages\CreateNeighbourhood::route('/create'),
            'edit'   => Pages\EditNeighbourhood::route('/{record}/edit'),
        ];
    }
}
