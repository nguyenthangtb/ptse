<?php

namespace App\Filament\Resources\ProductViewResource\Pages;

use App\Filament\Resources\ProductViewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductView extends EditRecord
{
    protected static string $resource = ProductViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
