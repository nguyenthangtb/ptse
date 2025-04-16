<?php

namespace App\Filament\Resources\WebsiteConfigResource\Pages;

use App\Filament\Resources\WebsiteConfigResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use App\Models\WebsiteConfig;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class ManageWebsiteSettings extends ManageRecords
{
    protected static string $resource = WebsiteConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('configureWebsite')
                ->label('Cấu hình nhanh')
                ->icon('heroicon-o-cog')
                ->color('primary')
                ->form([
                    Section::make('Thông tin chung')
                        ->description('Thông tin cơ bản của website')
                        ->schema([
                            TextInput::make('website_name')
                                ->label('Tên Website')
                                ->default(fn () => WebsiteConfig::get('website_name', 'My Awesome Website')),
                            TextInput::make('email_address')
                                ->label('Email')
                                ->email()
                                ->default(fn () => WebsiteConfig::get('email_address', 'contact@example.com')),
                            Forms\Components\Textarea::make('description')
                                ->label('Mô tả ngắn')
                                ->default(fn () => WebsiteConfig::get('description')),
                        ]),
                    Section::make('Thông tin liên hệ')
                        ->schema([
                            TextInput::make('phone_number')
                                ->label('Số điện thoại')
                                ->tel()
                                ->default(fn () => WebsiteConfig::get('phone_number', '+1 (555) 123-4567')),
                            TextInput::make('address_line_1')
                                ->label('Địa chỉ (Dòng 1)')
                                ->default(fn () => WebsiteConfig::get('address_line_1', '123 Main Street')),
                            TextInput::make('address_line_2')
                                ->label('Địa chỉ (Dòng 2)')
                                ->default(fn () => WebsiteConfig::get('address_line_2', 'Suite 100'))
                                ->placeholder('Tùy chọn'),
                        ]),
                    Section::make('Cài đặt bổ sung')
                        ->collapsed()
                        ->schema([
                            TextInput::make('facebook_url')
                                ->label('Facebook URL')
                                ->url()
                                ->placeholder('https://facebook.com/yourpage')
                                ->default(fn () => WebsiteConfig::get('facebook_url')),
                            TextInput::make('twitter_url')
                                ->label('Twitter URL')
                                ->url()
                                ->placeholder('https://twitter.com/yourhandle')
                                ->default(fn () => WebsiteConfig::get('twitter_url')),
                        ]),
                ])
                ->action(function (array $data): void {
                    // Lưu từng cấu hình vào database
                    foreach ($data as $key => $value) {
                        if (!empty($value)) {
                            WebsiteConfig::set($key, $value);
                        }
                    }

                    Notification::make()
                        ->title('Lưu cấu hình thành công')
                        ->success()
                        ->send();
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'Cấu hình Website';
    }

    public function getSubheading(): string
    {
        return 'Quản lý các cài đặt cơ bản của website';
    }
}
