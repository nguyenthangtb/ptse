<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-play-circle';

    protected static ?string $navigationLabel = 'Dịch vụ';

    // Nội dung là chính xác tên nhóm navigation hiện có
    protected static ?string $navigationGroup = 'Nội dung';

    protected static ?int $navigationSort = 999;

    protected static ?string $slug = 'video-services';

    protected static bool $shouldRegisterNavigation = true;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin Video')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Tiêu đề')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true),

                        Forms\Components\TextInput::make('video_url')
                            ->label('URL Video')
                            ->required()
                            ->url()
                            ->maxLength(255)
                            ->helperText('Nhập URL YouTube (VD: https://www.youtube.com/watch?v=ABCDEFG)'),

                        Forms\Components\Textarea::make('description')
                            ->label('Mô tả')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('thumbnail')
                            ->label('Hình thu nhỏ')
                            ->image()
                            ->directory('services')
                            ->columnSpanFull()
                            ->helperText('Nếu để trống, hình thu nhỏ sẽ được lấy từ YouTube'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Tùy chọn hiển thị')
                    ->schema([
                        Forms\Components\Toggle::make('status')
                            ->label('Kích hoạt')
                            ->default(true),

                        Forms\Components\TextInput::make('order')
                            ->label('Thứ tự')
                            ->numeric()
                            ->default(0)
                            ->helperText('Số nhỏ hơn hiển thị trước'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Hình thu nhỏ')
                    ->defaultImageUrl(fn (Service $record): string => "https://img.youtube.com/vi/{$record->youtube_id}/mqdefault.jpg")
                    ->circular(),

                Tables\Columns\IconColumn::make('status')
                    ->label('Trạng thái')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Cập nhật')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ReplicateAction::make()
                    ->beforeReplicaSaved(function (Service $record, Service $replica) {
                        $replica->title = $record->title . ' (Sao chép)';
                        $replica->save();
                    })
                    ->successNotification(
                        Notification::make()
                             ->success()
                             ->title('Dịch vụ đã được sao chép')
                             ->body('Dịch vụ đã được sao chép thành công.'),
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
            ->defaultSort('order');
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
