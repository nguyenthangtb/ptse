<?php

namespace App\Filament\Resources\SolutionResource\Pages;

use App\Filament\Resources\SolutionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Cache;

class CreateSolution extends CreateRecord
{
    protected static string $resource = SolutionResource::class;

    protected function afterCreate(): void
    {
        $this->clearSolutionCache();
    }

    protected function clearSolutionCache(): void
    {
        Cache::flush();
    }
}
