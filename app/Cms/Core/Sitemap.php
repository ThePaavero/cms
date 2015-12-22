<?php

namespace App\Cms\Core;

class Sitemap
{
    public function __construct()
    {
        $this->pages = Page::all();
    }

    public function getNestedArrayOfAllPages()
    {
        $pages = $this->pages->toArray();

        dd('aaargh');
    }
}
