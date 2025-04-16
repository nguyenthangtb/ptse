<?php

namespace App\Filament\Resources\WebsiteConfigResource\Pages;

use App\Filament\Resources\WebsiteConfigResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebsiteConfig extends EditRecord
{
    protected static string $resource = WebsiteConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
