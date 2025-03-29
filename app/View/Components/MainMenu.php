<?php

namespace App\View\Components;

use App\Models\Menu;
use Illuminate\View\Component;

class MainMenu extends Component
{
    public $menuItems;

    public function __construct()
    {
        $menu = Menu::where('location', 'main-menu')
            ->where('is_active', true)
            ->first();

        $this->menuItems = $menu ? $menu->items()
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get() : collect();
    }

    public function render()
    {
        return view('components.main-menu');
    }
}
