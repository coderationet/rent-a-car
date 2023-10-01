<?php

namespace App\View\Components;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageSidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct($page = null)
    {
        $this->page = $page;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $pages = cache()->remember('all_pages', 60, function () {
            return Page::all();
        });
        $page = $this->page;
        return view('components.page-sidebar', compact('pages', 'page'));
    }
}
