<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Dự án';
    protected static ?string $modelLabel = 'Dự án';
    protected static ?string $pluralModelLabel = 'Dự án';
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
                                                    ->required($locale === 'vi')
                                                    ->maxLength(255)
                                                    ->live(onBlur: true),
                                            ]);
                                    })->toArray())
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('slug')
                                    ->label('Đường dẫn')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                // Forms\Components\Select::make('solution_id')
                                //     ->label('Giải pháp')
                                //     ->relationship('solution', 'title')
                                //     ->required()
                                //     ->searchable()
                                //     ->preload(),
                                Forms\Components\Tabs::make('Khách hàng')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                Forms\Components\TextInput::make("client.{$locale}")
                                                    ->label('Khách hàng')
                                                    ->maxLength(255),
                                            ]);
                                    })->toArray())
                                    ->columnSpanFull(),
                                Forms\Components\Tabs::make('Địa điểm')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                Forms\Components\TextInput::make("location.{$locale}")
                                                    ->label('Địa điểm')
                                                    ->maxLength(255),
                                            ]);
                                    })->toArray())
                                    ->columnSpanFull(),
                                Forms\Components\DatePicker::make('completed_at')
                                    ->label('Ngày hoàn thành'),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Nội dung')
                            ->schema([
                                Forms\Components\Tabs::make('Mô tả ngắn')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                TinyEditor::make("short_description.{$locale}")
                                                    ->label('Mô tả ngắn')
                                                    ->required($locale === 'vi')
                                                    ->showMenuBar()
                                                    ->columnSpanFull(),
                                            ]);
                                    })->toArray())
                                    ->columnSpanFull(),
                                Forms\Components\Tabs::make('Mô tả chi tiết')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                TinyEditor::make("description.{$locale}")
                                                    ->label('Mô tả chi tiết')
                                                    ->showMenuBar()
                                                    ->columnSpanFull(),
                                            ]);
                                    })->toArray())
                                    ->columnSpanFull(),
                                // Forms\Components\RichEditor::make('challenge')
                                //     ->label('Thách thức')
                                //     ->columnSpanFull(),
                                // Forms\Components\RichEditor::make('solution')
                                //     ->label('Giải pháp')
                                //     ->required()
                                //     ->columnSpanFull(),
                                // Forms\Components\RichEditor::make('results')
                                //     ->label('Kết quả')
                                //     ->columnSpanFull(),
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
                                Forms\Components\TextInput::make('number_view')
                                    ->label('Số lượt xem')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->rule('integer'),
                            ]),

                        Forms\Components\Section::make('Hình ảnh')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Ảnh đại diện')
                                    ->image()
                                    ->previewable(true)
                                    ->directory('projects'),
                                Forms\Components\FileUpload::make('gallery')
                                    ->label('Thư viện ảnh')
                                    ->multiple()
                                    ->image()
                                    ->downloadable()
                                    ->openable()
                                    ->previewable(true)
                                    ->panelLayout('grid')
                                    ->directory('projects/gallery')
                                    ->reorderable(),
                            ]),

                        Forms\Components\Section::make('SEO')
                            ->schema([
                                Forms\Components\Tabs::make('SEO Tabs')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                Forms\Components\TextInput::make("meta_title.{$locale}")
                                                    ->label('Tiêu đề SEO')
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make("meta_description.{$locale}")
                                                    ->label('Mô tả SEO')
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make("meta_keywords.{$locale}")
                                                    ->label('Từ khóa SEO')
                                                    ->maxLength(255),
                                            ]);
                                    })->toArray()),
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
                // Tables\Columns\TextColumn::make('solution.title')
                //     ->label('Giải pháp')
                //     ->searchable()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('client')
                    ->label('Khách hàng')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Địa điểm')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('completed_at')
                    ->label('Ngày hoàn thành')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Nổi bật')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Kích hoạt')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_view')
                    ->label('Lượt xem')
                    ->numeric()
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
                // Tables\Filters\SelectFilter::make('solution')
                //     ->label('Giải pháp')
                //     ->relationship('solution', 'title')
                //     ->searchable()
                //     ->preload(),
                Tables\Filters\Filter::make('completed_at')
                    ->label('Ngày hoàn thành')
                    ->form([
                        Forms\Components\DatePicker::make('completed_from')
                            ->label('Từ ngày'),
                        Forms\Components\DatePicker::make('completed_until')
                            ->label('Đến ngày'),
                    ]),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Nổi bật'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Kích hoạt'),
            ])
            ->actions([
                Tables\Actions\ReplicateAction::make()
                    ->beforeReplicaSaved(function (Project $record, Project $replica) {
                        foreach (config('app.locales', [config('app.locale')]) as $locale) {
                            $original = $record->getTranslation('title', $locale, false);
                            if ($original) {
                                $replica->setTranslation('title', $locale, $original . ' (Sao chép)');
                            }
                        }
                        $replica->slug = $record->slug . '-copy';
                        $replica->save();
                    })
                    ->successNotification(
                        Notification::make()
                             ->success()
                             ->title('Dự án đã được sao chép')
                             ->body('Dự án đã được sao chép thành công.'),
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
    //         RelationManagers\CommentsRelationManager::make(),
    //     ];
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
