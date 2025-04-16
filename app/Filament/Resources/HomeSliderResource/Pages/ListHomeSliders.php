<?php

namespace App\Filament\Resources\HomeSliderResource\Pages;

use App\Filament\Resources\HomeSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomeSliders extends ListRecords
{
    protected static string $resource = HomeSliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
