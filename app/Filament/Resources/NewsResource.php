<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;
class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Tin tức';

    protected static ?string $modelLabel = 'tin tức';

    protected static ?string $pluralModelLabel = 'tin tức';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Thông tin chính')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Tiêu đề')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                    ),
                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(News::class, 'slug', ignoreRecord: true),
                                Forms\Components\RichEditor::make('content')
                                    ->label('Nội dung')
                                    ->required()
                                    ->columnSpanFull(),
                                Forms\Components\Textarea::make('excerpt')
                                    ->label('Tóm tắt')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Section::make('Hình ảnh & Thời gian')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Hình ảnh')
                                    ->image()
                                    ->directory('news')
                                    ->columnSpanFull(),
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Ngày xuất bản')
                                    ->required(),
                                Forms\Components\DateTimePicker::make('date')
                                    ->label('Ngày hiển thị')
                                    ->required(),
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
                        Forms\Components\Section::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->label('Meta Title'),
                                Forms\Components\Textarea::make('meta_description')
                                    ->label('Meta Description')
                                    ->rows(3),
                                Forms\Components\TextInput::make('meta_keywords')
                                    ->label('Meta Keywords'),
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
                    ->label('Hình ảnh'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Ngày xuất bản')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Kích hoạt')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Cập nhật')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Kích hoạt')
                    ->boolean()
                    ->trueLabel('Tin đang kích hoạt')
                    ->falseLabel('Tin đã tắt')
                    ->native(false),
                Tables\Filters\Filter::make('published')
                    ->label('Đã xuất bản')
                    ->query(fn ($query) => $query->published())
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ReplicateAction::make()
                    ->beforeReplicaSaved(function (News $record, News $replica) {
                        $replica->title = $record->title . ' (Sao chép)';
                        $replica->slug = $record->slug . '-copy';
                        $replica->save();
                    })
                    ->successNotification(
                        Notification::make()
                             ->success()
                             ->title('Tin tức đã được sao chép')
                             ->body('Tin tức đã được sao chép thành công.'),
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
            ])
            ->defaultSort('published_at', 'desc');
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
