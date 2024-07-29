<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeoManagement extends Component
{
    public $title;
    public $metaData;
    public $keywords;
    public $tags;
    public $image;
    public $author;
    public $slug;

    public function __construct($title = null, $metaData = null, $keywords = null, $tags = null, $image = null, $author = null, $slug = null)
    {
        $this->title = $title;
        $this->metaData = $metaData;
        $this->keywords = $keywords;
        $this->tags = $tags;
        $this->image = $image;
        $this->author = $author;
        $this->slug = $slug;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seo-management');
    }
}
