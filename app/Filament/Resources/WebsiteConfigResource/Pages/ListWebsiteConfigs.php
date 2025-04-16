<?php

namespace App\Filament\Resources\WebsiteConfigResource\Pages;

use App\Filament\Resources\WebsiteConfigResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebsiteConfigs extends ListRecords
{
    protected static string $resource = WebsiteConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
