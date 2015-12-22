<?php

namespace App\Cms\Core;

class Navigation
{
    public function __construct($tree)
    {
        $this->tree = $tree;
    }

    public function renderNestedList()
    {
        foreach ($this->tree as $uri => $array)
        {
            // ...
        }
    }

    public function echoKids($kids)
    {
        $html = '';

        $html .= '<ul>';

        foreach ($kids as $kid)
        {
            $html .= $this->echoKids($kid);
        }

        $html .= '</ul>';

        return $html;
    }

}
