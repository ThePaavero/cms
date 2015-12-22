<?php

namespace App\Cms\Core;

class Sitemap
{
    public function __construct()
    {
        // ...
    }

    public function getNestedArrayOfAllPages()
    {
        $pages = Page::all();

        $tree = [];

        foreach ($pages as $page)
        {
            $uri = $page->uri;
            $uriParts = explode('/', $uri);
            $subTree = [array_pop($uriParts)];

            foreach (array_reverse($uriParts) as $segment)
            {
                $subTree = [$segment => $subTree];
            }

            $tree = array_merge_recursive($tree, $subTree);
        }

        dd($tree);

        return $pages;
    }

}
