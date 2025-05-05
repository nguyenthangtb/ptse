<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Danh mục';
    protected static ?string $modelLabel = 'Danh mục';
    protected static ?string $pluralModelLabel = 'Danh mục';

    public static function form(Form $form): Form
    {
        $locales = config('app.locales', [config('app.locale')]);
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                // Đặt tabs cho tiêu đề đa ngôn ngữ
                                Forms\Components\Tabs::make('Tiêu đề')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                Forms\Components\TextInput::make("name.{$locale}")
                                                    ->label('Tên danh mục')
                                                    ->required()
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                                                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                                    ),
                                            ]);
                                    })->toArray())
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('slug')
                                    ->label('Đường dẫn')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                Forms\Components\Select::make('parent_id')
                                    ->label('Danh mục cha')
                                    ->options(Category::where('parent_id', null)->pluck('name', 'id'))
                                    ->searchable(),
                                Forms\Components\TextInput::make('order')
                                    ->label('Thứ tự')
                                    ->numeric()
                                    ->default(0),
                            ])
                            ->columns(2),


                        Forms\Components\Section::make('Mô tả')
                            ->schema([
                                Forms\Components\Tabs::make('Mô tả')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                Forms\Components\Textarea::make("short_description.{$locale}")
                                                    ->label('Mô tả ngắn')
                                                    ->rows(3),
                                                Forms\Components\RichEditor::make("description.{$locale}")
                                                    ->label('Mô tả chi tiết')
                                                    ->columnSpanFull(),
                                            ]);
                                    })->toArray())
                                    ->columnSpanFull(),
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
                            ]),

                        Forms\Components\Section::make('Hình ảnh')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Ảnh')
                                    ->image()
                                    ->disk('public')
                                    ->directory('categories')
                                    ->imageEditor()
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Section::make('SEO')
                            ->schema([
                                Forms\Components\Tabs::make('SEO')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                Forms\Components\TextInput::make("meta_title.{$locale}")
                                                    ->label('Tiêu đề SEO')
                                                    ->columnSpanFull(),
                                                Forms\Components\TextInput::make("meta_description.{$locale}")
                                                    ->label('Mô tả SEO')
                                                    ->columnSpanFull(),
                                                Forms\Components\TextInput::make("meta_keywords.{$locale}")
                                                    ->label('Từ khóa SEO')
                                                    ->columnSpanFull(),
                                            ]);
                                    })->toArray())
                                    ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên danh mục')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('parent.name')
                    ->label('Danh mục cha')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
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
                Tables\Filters\SelectFilter::make('parent_id')
                    ->label('Danh mục cha')
                    ->options(Category::where('parent_id', null)->pluck('name', 'id'))
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\ReplicateAction::make()
                    ->beforeReplicaSaved(function (Category $record, Category $replica) {
                        $replica->name = $record->name . ' (Sao chép)';
                        $replica->slug = $record->slug . '-copy';
                        $replica->save();
                    })
                    ->successNotification(
                        Notification::make()
                             ->success()
                             ->title('Danh mục đã được sao chép')
                             ->body('Danh mục đã được sao chép thành công.'),
                    ),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
