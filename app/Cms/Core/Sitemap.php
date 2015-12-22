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

        $tree = [];

        foreach ($pages as $page)
        {
            $segments = explode('/', $page['uri']);

            if ( ! isset($page['children']))
            {
                $page['children'] = [];
            }

            if ( ! isset($tree[$segments[0]]))
            {
                $tree[$segments[0]] = [];
            }

            $current = &$tree;
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

        $tree = $this->cleanUpNestedArray($tree);

        return $tree;
    }

    public function cleanUpNestedArray($tree)
    {
        // @todo :)
        return $tree;
    }

}
