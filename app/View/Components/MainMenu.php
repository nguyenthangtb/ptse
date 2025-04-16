<?php

namespace App\View\Components;

use App\Services\MenuService;
use Illuminate\View\Component;

class MainMenu extends Component
{
    public $menuItems;

    public function __construct(MenuService $menuService)
    {
        $this->menuItems = $menuService->getMainMenu();
    }

    public function render()
    {
        return view('components.main-menu');
    }
}
