<?php

namespace App\View\Components\Home;

use App\Models\Partner;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class Partners extends Component
{
    public Collection $partners;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->partners = Partner::active()->ordered()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home.partners');
    }
}
