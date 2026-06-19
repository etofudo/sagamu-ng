<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Header')->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(200)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('kicker')
                    ->placeholder('Short label above the headline, e.g. "Neighbourhood Guide"')
                    ->maxLength(100),

                Forms\Components\TextInput::make('author')
                    ->maxLength(100),

                Forms\Components\Textarea::make('excerpt')
                    ->rows(2)
                    ->maxLength(300)
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Content')->schema([
                Forms\Components\FileUpload::make('hero_image')
                    ->image()
                    ->directory('articles')
                    ->maxSize(3072)
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('body')
                    ->required()
                    ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'orderedList', 'h2', 'h3', 'blockquote'])
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Publishing')->schema([
                Forms\Components\Toggle::make('is_published')
                    ->default(false)
                    ->reactive(),

                Forms\Components\DateTimePicker::make('published_at')
                    ->label('Publish date')
                    ->default(now()),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->limit(50)->sortable(),
                Tables\Columns\TextColumn::make('kicker')->searchable()->limit(30),
                Tables\Columns\TextColumn::make('author'),
                Tables\Columns\IconColumn::make('is_published')->boolean()->label('Published'),
                Tables\Columns\TextColumn::make('published_at')->dateTime()->sortable()->since(),
            ])
            ->defaultSort('published_at', 'desc')
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
            'index'  => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit'   => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
