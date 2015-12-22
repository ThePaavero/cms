<?php

namespace App\Cms\Core;

class UriMapper
{
    public $uri;

    public function __construct($uri)
    {
        $uri = ltrim($uri, '/');
        $this->uri = $uri;
    }

    public function getMappedPage()
    {
        $page = Page::where('uri', $this->uri)->first();

        if ( ! $page)
        {
            return false;
        }

        return $page;
    }
}
