<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerResource\Pages;
use App\Filament\Resources\CareerResource\RelationManagers;
use App\Models\Career;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

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
                                Forms\Components\TextInput::make('department')
                                    ->label('Phòng ban')
                                    ->required(),
                                Forms\Components\TextInput::make('location')
                                    ->label('Địa điểm')
                                    ->required(),
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
                                Forms\Components\TextInput::make('short_description')
                                    ->label('Mô tả ngắn')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\RichEditor::make('description')
                                    ->label('Mô tả chi tiết')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Section::make('Yêu cầu & Quyền lợi')
                            ->schema([
                                Forms\Components\RichEditor::make('requirements')
                                    ->label('Yêu cầu')
                                    ->required()
                                    ->columnSpanFull(),
                                Forms\Components\RichEditor::make('benefits')
                                    ->label('Quyền lợi')
                                    ->required()
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
                                    ->label('Lương tối thiểu')
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\TextInput::make('salary_max')
                                    ->label('Lương tối đa')
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
                Tables\Columns\TextColumn::make('salary_range')
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
                    ->options(fn () => Career::distinct()->pluck('department', 'department')->toArray())
                    ->searchable(),
                Tables\Filters\SelectFilter::make('location')
                    ->label('Địa điểm')
                    ->options(fn () => Career::distinct()->pluck('location', 'location')->toArray())
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
