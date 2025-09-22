<?php

namespace App\Filament\Resources;

use App\Models\Introduce;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use App\Filament\Resources\IntroduceResource\Pages;

class IntroduceResource extends Resource
{
    protected static ?string $model = Introduce::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Giới thiệu';

    protected static ?string $modelLabel = 'Giới thiệu';

    protected static ?string $pluralModelLabel = 'Giới thiệu';

    protected static ?string $slug = 'introduce';

    public static function form(Form $form): Form
    {
        $locales = config('app.locales', [config('app.locale')]);
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([

                        Forms\Components\Tabs::make('Tiêu đề')
                            ->tabs(collect($locales)->map(function ($locale) {
                                return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                    ->schema([
                                        Forms\Components\TextInput::make("title.{$locale}")
                                            ->label('Tiêu đề')
                                            ->required(),
                                    ]);
                            })->toArray())
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('section')
                            ->label('Phần')
                            ->required()
                            ->maxLength(50),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Thứ tự sắp xếp')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('status')
                            ->label('Trạng thái')
                            ->default(true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Nội dung')
                    ->schema([
                        Forms\Components\Tabs::make('Nội dung')
                            ->tabs(collect($locales)->map(function ($locale) {
                                return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                    ->schema([
                                        TinyEditor::make("content.{$locale}")
                                            ->label('Nội dung')
                                            ->showMenuBar()
                                            ->required(),
                                    TinyEditor::make("content.{$locale}")
                                            ->label('Nội dung')
                                            ->showMenuBar()
                                            ->columnSpanFull(),
                                    ]);
                            })->toArray())
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\Tabs::make('SEO')
                            ->tabs(collect($locales)->map(function ($locale) {
                                return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                    ->schema([
                                        Forms\Components\TextInput::make("meta_title.{$locale}")
                                            ->label('Tiêu đề SEO'),
                                        Forms\Components\Textarea::make("meta_content.{$locale}")
                                            ->label('Mô tả SEO')
                                            ->rows(3),
                                        Forms\Components\TextInput::make("meta_keywords.{$locale}")
                                            ->label('Từ khóa SEO'),
                                    ]);
                            })->toArray())
                            ->columnSpanFull(),

                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section')
                    ->label('Phần')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title.vi')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Thứ tự')
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->label('Trạng thái')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Trạng thái'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIntroduce::route('/'),
            'create' => Pages\CreateIntroduce::route('/create'),
            'edit' => Pages\EditIntroduce::route('/{record}/edit'),
        ];
    }
}
