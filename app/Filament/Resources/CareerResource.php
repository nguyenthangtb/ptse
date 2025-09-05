<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerResource\Pages;
use App\Models\Career;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
class CareerResource extends Resource
{
    protected static ?string $model = Career::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Nội dung';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Tuyển dụng';

    protected static ?string $pluralModelLabel = 'Tuyển dụng';

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
                                Forms\Components\Tabs::make('Phòng ban')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                Forms\Components\TextInput::make("department.{$locale}")
                                                    ->label('Phòng ban')
                                                    ->required(),
                                            ]);
                                    })->toArray()),
                                Forms\Components\Tabs::make('Địa điểm')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                Forms\Components\TextInput::make("location.{$locale}")
                                                    ->label('Địa điểm')
                                                    ->required(),
                                            ]);
                                    })->toArray()),
                                Forms\Components\Select::make('type')
                                    ->label('Loại hình')
                                    ->required()
                                    ->options([
                                        'full-time' => 'Toàn thời gian',
                                        'part-time' => 'Bán thời gian',
                                        'contract' => 'Hợp đồng',
                                        'internship' => 'Thực tập',
                                        'remote' => 'Từ xa',
                                    ]),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Mô tả')
                            ->schema([
                                Forms\Components\Tabs::make('Mô tả ngắn')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                TinyEditor::make("short_description.{$locale}")
                                                    ->label('Mô tả ngắn')
                                                    ->showMenuBar()
                                                    ->maxLength(255),
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
                            ]),

                        Forms\Components\Section::make('Yêu cầu & Quyền lợi')
                            ->schema([
                                Forms\Components\Tabs::make('Yêu cầu')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                TinyEditor::make("requirements.{$locale}")
                                                    ->label('Yêu cầu')
                                                    ->showMenuBar()
                                                    ->columnSpanFull(),
                                            ]);
                                    })->toArray())
                                    ->columnSpanFull(),
                                Forms\Components\Tabs::make('Quyền lợi')
                                    ->tabs(collect($locales)->map(function ($locale) {
                                        return Forms\Components\Tabs\Tab::make(strtoupper($locale))
                                            ->schema([
                                                TinyEditor::make("benefits.{$locale}")
                                                    ->label('Quyền lợi')
                                                    ->showMenuBar()
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
                                Forms\Components\DatePicker::make('deadline')
                                    ->label('Hạn nộp hồ sơ'),
                            ]),

                        Forms\Components\Section::make('Mức lương')
                            ->schema([
                                Forms\Components\TextInput::make('salary_min')
                                    ->label('Mức lương')
                                    ->numeric()
                                    ->prefix('$'),
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department')
                    ->label('Phòng ban')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Địa điểm')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Loại hình')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('salary')
                    ->label('Mức lương')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Kích hoạt')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deadline')
                    ->label('Hạn nộp')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
                    ->label('Đã xoá'),
                Tables\Filters\SelectFilter::make('department')
                    ->label('Phòng ban')
                    ->options(function () {
                        $departments = Career::whereNotNull('department')
                            ->where('department', '!=', '')
                            ->distinct()
                            ->pluck('department', 'department')
                            ->filter()
                            ->toArray();

                        return $departments;
                    })
                    ->searchable(),
                Tables\Filters\SelectFilter::make('location')
                    ->label('Địa điểm')
                    ->options(function () {
                        $locations = Career::whereNotNull('location')
                            ->where('location', '!=', '')
                            ->distinct()
                            ->pluck('location', 'location')
                            ->filter()
                            ->toArray();

                        return $locations;
                    })
                    ->searchable(),
                Tables\Filters\SelectFilter::make('type')
                    ->label('Loại hình')
                    ->options([
                        'full-time' => 'Toàn thời gian',
                        'part-time' => 'Bán thời gian',
                        'contract' => 'Hợp đồng',
                        'internship' => 'Thực tập',
                        'remote' => 'Từ xa',
                    ]),
                Tables\Filters\Filter::make('deadline')
                    ->label('Hạn nộp')
                    ->form([
                        Forms\Components\DatePicker::make('deadline_from')
                            ->label('Từ ngày'),
                        Forms\Components\DatePicker::make('deadline_until')
                            ->label('Đến ngày'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['deadline_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('deadline', '>=', $date),
                            )
                            ->when(
                                $data['deadline_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('deadline', '<=', $date),
                            );
                    }),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Kích hoạt'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Sửa'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xoá'),
                Tables\Actions\ForceDeleteAction::make()
                    ->label('Xoá vĩnh viễn'),
                Tables\Actions\RestoreAction::make()
                    ->label('Khôi phục'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xoá'),
                    Tables\Actions\ForceDeleteBulkAction::make()
                        ->label('Xoá vĩnh viễn'),
                    Tables\Actions\RestoreBulkAction::make()
                        ->label('Khôi phục'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareer::route('/create'),
            'edit' => Pages\EditCareer::route('/{record}/edit'),
        ];
    }
}
