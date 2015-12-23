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
        $html = "<ul>\n";

        $html .= $this->echoChildren($this->tree, 0, '');
        $html .= "</ul>\n";

        return $html;
    }

    public function echoChildren($item, $nestlevel, $html)
    {
        if (isset($item['title']))
        {
            $html .= "<li>\n";
            $html .= "<a href='" . url($item['uri']) . "' data-id='" . $item['id'] . "'>\n";
            $html .= $item['title'] . "\n";
            $html .= "</a>\n";
            $html .= "</li>\n";
        }

        foreach ($item as $child)
        {
            if (is_array($child))
            {
                $isNewList = isset($child[0]['title']) && $nestlevel > 0;

                if ($isNewList) $html .= "<ul>\n";

                $html .= $this->echoChildren($child, $nestlevel + 1, '');

                if ($isNewList) $html .= "</ul>\n";
            }
        }

        return $html;
    }

}
