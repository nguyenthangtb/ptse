<?php

namespace App\Filament\Resources\IntroduceResource\Pages;

use App\Filament\Resources\IntroduceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIntroduce extends EditRecord
{
    protected static string $resource = IntroduceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
