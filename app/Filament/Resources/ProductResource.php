<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Sản phẩm';
    protected static ?string $modelLabel = 'Sản phẩm';
    protected static ?string $pluralModelLabel = 'Sản phẩm';

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
                                                    ->label('Tên sản phẩm')
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
                                Forms\Components\Select::make('category_id')
                                    ->label('Danh mục')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->searchable()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Tên danh mục')
                                            ->required()
                                            ->unique(),
                                        Forms\Components\TextInput::make('slug')
                                            ->label('Đường dẫn')
                                            ->required()
                                            ->unique(),
                                    ]),
                                Forms\Components\TextInput::make('order')
                                    ->label('Thứ tự')
                                    ->numeric()
                                    ->default(0),
                            ])
                            ->columns(2),

                        // Mô tả
                        Forms\Components\Tabs::make('Mô tả')
                            ->tabs(collect($locales)->map(function ($locale) {
                                return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                    ->schema([
                                        Forms\Components\Section::make('Mô tả')
                                            ->schema([
                                                Forms\Components\TextInput::make("short_description.{$locale}")
                                                    ->label('Mô tả ngắn')
                                                    ->maxLength(255),
                                                Forms\Components\RichEditor::make("description.{$locale}")
                                                    ->label('Mô tả chi tiết')
                                                    ->columnSpanFull(),
                                            ]),
                                    ]);
                            })->toArray())
                            ->columnSpanFull(),
                        // Tính năng
                        Forms\Components\Tabs::make('Tính năng')
                            ->tabs(collect($locales)->map(function ($locale) {
                                return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                    ->schema([
                                        Forms\Components\Section::make('Tính năng')
                                            ->schema([
                                                Forms\Components\RichEditor::make("features.{$locale}")
                                                    ->label('Tính năng')
                                                    ->columnSpanFull(),
                                            ]),
                                    ]);
                            })->toArray())
                            ->columnSpanFull(),

                            Forms\Components\Section::make('Thông số kỹ thuật')
                            ->schema([
                                Forms\Components\Tabs::make('Thông số')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                Forms\Components\Repeater::make("specifications.{$locale}")
                                                    ->label('Thông số')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('label')
                                                            ->label('Tên thông số')
                                                            ->required(),
                                                        Forms\Components\TextInput::make('value')
                                                            ->label('Giá trị')
                                                            ->required(),
                                                    ])
                                                    ->columns(2)
                                                    ->columnSpanFull()
                                                    ->defaultItems(0)
                                                    ->reorderable()
                                                    ->collapsible(),
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
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Nổi bật'),
                            ]),

                        Forms\Components\Section::make('Hình ảnh')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Ảnh đại diện')
                                    ->image()
                                    ->directory('products'),
                            ]),

                        Forms\Components\Section::make('Thư viện ảnh')
                            ->schema([
                                Forms\Components\FileUpload::make('gallery')
                                    ->label('Ảnh')
                                    ->multiple()
                                    ->panelLayout('grid')
                                    ->directory('products/gallery')
                                    ->reorderable(),
                            ]),

                        Forms\Components\Section::make('Tài liệu')
                            ->schema([
                                Forms\Components\FileUpload::make('documents')
                                    ->label('Tài liệu')
                                    ->multiple()
                                    ->preserveFilenames()
                                    ->panelLayout('grid')
                                    ->directory('products/documents')
                                    ->acceptedFileTypes(['application/pdf', 'application/msword'])
                                    ->reorderable(),
                            ]),

                        // SEO
                        Forms\Components\Tabs::make('SEO')
                            ->tabs(collect($locales)->map(function ($locale) {
                                return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                    ->schema([
                                        Forms\Components\Section::make('SEO')
                                            ->schema([
                                                Forms\Components\TextInput::make("meta_title.{$locale}")
                                                    ->label('Tiêu đề SEO'),
                                                Forms\Components\TextInput::make("meta_description.{$locale}")
                                                    ->label('Mô tả SEO'),
                                                Forms\Components\TextInput::make("meta_keywords.{$locale}")
                                                    ->label('Từ khóa SEO'),
                                            ]),
                                    ]);
                            })->toArray())
                            ->columnSpanFull(),
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
                    ->label('Tên sản phẩm')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Danh mục')
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
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
                    ->label('Đã xóa'),
                Tables\Filters\SelectFilter::make('category')
                    ->label('Danh mục')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Nổi bật'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Kích hoạt'),
            ])
            ->actions([
                Tables\Actions\ReplicateAction::make()
                    ->beforeReplicaSaved(function (Product $record, Product $replica) {
                        $replica->name = $record->name . ' (Sao chép)';
                        $replica->slug = $record->slug . '-copy';
                        $replica->save();
                    })
                    ->successNotification(
                        Notification::make()
                             ->success()
                             ->title('Sản phẩm đã được sao chép')
                             ->body('Sản phẩm đã được sao chép thành công.'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
