<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SolutionResource\Pages;
use App\Filament\Resources\SolutionResource\RelationManagers;
use App\Models\Solution;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class SolutionResource extends Resource
{
    protected static ?string $model = Solution::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?string $navigationLabel = 'Giải pháp';
    protected static ?string $modelLabel = 'Giải pháp';
    protected static ?string $pluralModelLabel = 'Giải pháp';
    protected static ?string $navigationGroup = 'Nội dung';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Tiêu đề')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                    ),
                                Forms\Components\TextInput::make('slug')
                                    ->label('Đường dẫn')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                Forms\Components\TextInput::make('order')
                                    ->label('Thứ tự')
                                    ->numeric()
                                    ->default(0),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Mô tả')
                            ->schema([
                                Forms\Components\TextInput::make('short_description')
                                    ->label('Mô tả ngắn')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\RichEditor::make('description')
                                    ->label('Mô tả chi tiết')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Section::make('Tính năng & Lợi ích')
                            ->schema([
                                Forms\Components\Repeater::make('features')
                                    ->label('Tính năng')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Tiêu đề')
                                            ->required(),
                                        Forms\Components\Textarea::make('description')
                                            ->label('Mô tả')
                                            ->required()
                                            ->rows(2),
                                    ])
                                    ->defaultItems(0)
                                    ->grid(2)
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),

                                Forms\Components\Repeater::make('benefits')
                                    ->label('Lợi ích')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Tiêu đề')
                                            ->required(),
                                        Forms\Components\Textarea::make('description')
                                            ->label('Mô tả')
                                            ->required()
                                            ->rows(2),
                                    ])
                                    ->defaultItems(0)
                                    ->grid(2)
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Trạng thái')
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Kích hoạt')
                                    ->default(true),
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Nổi bật'),
                            ]),

                        Forms\Components\Section::make('Hình ảnh')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Ảnh đại diện')
                                    ->image()
                                    ->directory('solutions'),
                                Forms\Components\FileUpload::make('gallery')
                                    ->label('Thư viện ảnh')
                                    ->multiple()
                                    ->image()
                                    ->directory('solutions/gallery')
                                    ->reorderable(),
                            ]),

                        Forms\Components\Section::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->label('Tiêu đề SEO'),
                                Forms\Components\TextInput::make('meta_description')
                                    ->label('Mô tả SEO'),
                                Forms\Components\TextInput::make('meta_keywords')
                                    ->label('Từ khóa SEO'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Ảnh')
                    ->square(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Nổi bật')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Kích hoạt')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
                    ->label('Đã xóa'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Nổi bật'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Kích hoạt'),
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

    public static function getRelations(): array
    {
        return [
            RelationManagers\ProjectsRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSolutions::route('/'),
            'create' => Pages\CreateSolution::route('/create'),
            'edit' => Pages\EditSolution::route('/{record}/edit'),
        ];
    }
}
