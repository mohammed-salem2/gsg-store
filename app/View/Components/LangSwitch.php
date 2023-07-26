<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\View\Component;

class LangSwitch extends Component
{
    public $langs = [
        'ar' => 'العربية' ,
        'en' => 'English' ,
    ];
    public $locale;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->locale = App::currentLocale();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.lang-switch');
    }
}
