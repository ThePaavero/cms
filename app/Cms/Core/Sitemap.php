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
        $pages = $this->pages;

        $tree = [];

        foreach ($pages as $page)
        {
            $uri = $page->uri;
            if ($uri === '')
            {
                // All pages are technically "children" of the home page, skip it its part...
                continue;
            }

            $tree[$uri] = $this->getKidsRecursive($page);
        }

        dd($tree);

        return $pages;
    }

    public function getKidsRecursive($parentPage)
    {
        $parentUri = $parentPage->uri;
        $parentSegmentCount = count(explode('/', $parentUri));
        $kids = [];

        // Get all pages that match my uri (plus has at least one more segment)
        foreach ($this->pages as $page)
        {
            if (strpos($page->uri, $parentUri) === 0 && $page->uri != $parentUri)
            {
                // Let's check the length
                $kidSegmentCount = count(explode('/', $page->uri));
                if ($kidSegmentCount != ($parentSegmentCount + 1))
                {
                    continue;
                }

                // We're directly under our parent!
                $kids[] = $page;
            }
        }

        return $kids;
    }

}
