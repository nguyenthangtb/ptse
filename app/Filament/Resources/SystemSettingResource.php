<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SystemSettingResource\Pages;
use App\Filament\Resources\SystemSettingResource\RelationManagers;
use App\Models\SystemSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Component;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SystemSettingResource extends Resource
{
    protected static ?string $model = SystemSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Cài đặt hệ thống';
    protected static ?string $modelLabel = 'Cài đặt';
    protected static bool $shouldRegisterNavigation = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin chung')
                    ->schema([
                        Forms\Components\FileUpload::make('site_logo')
                            ->label('Logo website')
                            ->image()
                            ->directory('site')
                            ->live()
                            ->afterStateUpdated(function ($state) {
                                SystemSetting::updateOrCreate(
                                    ['key' => 'site_logo'],
                                    ['value' => $state, 'group' => 'general']
                                );
                            }),
                        Forms\Components\TextInput::make('site_name')
                            ->label('Tên website')
                            ->live()
                            ->afterStateUpdated(function ($state) {
                                SystemSetting::updateOrCreate(
                                    ['key' => 'site_name'],
                                    ['value' => $state, 'group' => 'general']
                                );
                            }),
                        Forms\Components\TextInput::make('site_email')
                            ->label('Email')
                            ->email()
                            ->afterStateUpdated(function ($state) {
                                SystemSetting::updateOrCreate(
                                    ['key' =>'site_email'],
                                    ['value' => $state, 'group' => 'general']
                                );
                            }),
                    ]),

                Forms\Components\Section::make('Thông tin liên hệ')
                    ->schema([
                        Forms\Components\TextInput::make('contact_phone')
                            ->label('Số điện thoại')
                            ->tel()
                            ->afterStateUpdated(function ($state) {
                                SystemSetting::updateOrCreate(
                                    ['key' =>'contact_phone'],
                                    ['value' => $state, 'group' => 'contact']
                                );
                            }),
                        Forms\Components\TextInput::make('contact_address')
                            ->label('Địa chỉ')
                            ->afterStateUpdated(function ($state) {
                                SystemSetting::updateOrCreate(
                                    ['key' =>'contact_address'],
                                    ['value' => $state, 'group' => 'contact']
                                );
                            })
                    ]),

                Forms\Components\Section::make('Giờ làm việc')
                    ->schema([
                        Forms\Components\TextInput::make('working_hours_weekday')
                            ->label('Thứ 2 - Thứ 6')
                            ->placeholder('9:00 – 18:00'),
                        Forms\Components\TextInput::make('working_hours_saturday')
                            ->label('Thứ 7')
                            ->placeholder('9:00 – 12:00'),
                        Forms\Components\TextInput::make('working_hours_sunday')
                            ->label('Chủ nhật')
                            ->placeholder('Nghỉ'),
                    ]),

                Forms\Components\Section::make('Mạng xã hội')
                    ->schema([
                        Forms\Components\TextInput::make('social_facebook')
                            ->label('Facebook URL'),
                        Forms\Components\TextInput::make('social_twitter')
                            ->label('Twitter URL'),
                        Forms\Components\TextInput::make('social_instagram')
                            ->label('Instagram URL'),
                        Forms\Components\TextInput::make('social_linkedin')
                            ->label('LinkedIn URL'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Khóa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Giá trị')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('group')
                    ->label('Nhóm')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('Nhóm')
                    ->options([
                        'general' => 'Thông tin chung',
                        'contact' => 'Liên hệ',
                        'social' => 'Mạng xã hội',
                        'working_hours' => 'Giờ làm việc',
                    ])
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
            'index' => Pages\ManageSystemSettings::route('/'),
        ];
    }
}
