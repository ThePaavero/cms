<?php

namespace App\Cms\ContentTypes;

class TextBlock
{
    public function __construct()
    {
        // ...
    }

    public function render($pageId)
    {
        return ['Hey, page "' . $pageId . '"!'];
    }
}
