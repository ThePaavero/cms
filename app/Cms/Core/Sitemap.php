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

        $newPages = [];

        foreach ($pages as $page)
        {
            $segments = explode('/', $page['uri']);

            if ( ! isset($page['children']))
            {
                $page['children'] = [];
            }

            if ( ! isset($newPages[$segments[0]]))
            {
                $newPages[$segments[0]] = [];
            }

            $current = &$newPages;
            for ($i = 0; $i < count($segments); $i ++)
            {
                $segment = $segments[$i];
                if ( ! isset($current[$segment]))
                {
                    $current[$segment] = [];
                }

                if ($i === count($segments) - 1)
                {
                    array_push($current[$segment], $page);
                }

                $current = &$current[$segment];
            }
        }

        return $newPages;
    }
}
