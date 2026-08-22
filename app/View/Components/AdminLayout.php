<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    public string $appearance;

    public function __construct(public string $title = 'Dashboard')
    {
        $this->appearance = Setting::getValue('appearance', 'light') === 'dark' ? 'dark' : 'light';
    }

    public function render(): View
    {
        return view('layouts.admin');
    }
}
