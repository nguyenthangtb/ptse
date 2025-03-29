<?php

namespace App\Filament\Resources\ProductViewResource\Pages;

use App\Filament\Resources\ProductViewResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProductView extends CreateRecord
{
    protected static string $resource = ProductViewResource::class;
}
