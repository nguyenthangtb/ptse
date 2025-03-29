<?php

namespace App\Filament\Resources\SystemSettingResource\Pages;

use App\Filament\Resources\SystemSettingResource;
use Filament\Resources\Pages\Page;
use App\Models\SystemSetting;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class ManageSystemSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = SystemSettingResource::class;
    protected static string $view = 'filament.resources.system-setting-resource.pages.manage-system-settings';
    
    public function mount(): void
    {
        $settings = SystemSetting::all()->pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    protected function getFormSchema(): array
    {
        return static::$resource::getFormSchema();
    }
}