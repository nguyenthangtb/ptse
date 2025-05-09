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
use Filament\Notifications\Notification;
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
        $locales = config('app.locales', [config('app.locale')]);
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Tabs::make('Tiêu đề')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                Forms\Components\TextInput::make("title.{$locale}")
                                                    ->label('Tiêu đề')
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
                                Forms\Components\Tabs::make('Mô tả')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                Forms\Components\TextInput::make("short_description.{$locale}")
                                                    ->label('Mô tả ngắn')
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\RichEditor::make("description.{$locale}")
                                                    ->label('Mô tả chi tiết')
                                                    ->required()
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
                                Forms\Components\Tabs::make('SEO')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                Forms\Components\TextInput::make("meta_title.{$locale}")
                                                    ->label('Tiêu đề SEO'),
                                                Forms\Components\TextInput::make("meta_description.{$locale}")
                                                    ->label('Mô tả SEO'),
                                                Forms\Components\TextInput::make("meta_keywords.{$locale}")
                                                    ->label('Từ khóa SEO'),
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
                Tables\Actions\ReplicateAction::make()
                    ->beforeReplicaSaved(function (Solution $record, Solution $replica) {
                        $replica->title = $record->title . ' (Sao chép)';
                        $replica->slug = $record->slug . '-copy';
                        $replica->save();
                    })
                    ->successNotification(
                        Notification::make()
                             ->success()
                             ->title('Giải pháp đã được sao chép')
                             ->body('Giải pháp đã được sao chép thành công.'),
                    ),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // public static function getRelations(): array
    // {
    //     return [
    //         RelationManagers\ProjectsRelationManager::make(),
    //     ];
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSolutions::route('/'),
            'create' => Pages\CreateSolution::route('/create'),
            'edit' => Pages\EditSolution::route('/{record}/edit'),
        ];
    }
}
