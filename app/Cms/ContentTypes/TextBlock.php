<?php

namespace App\Cms\ContentTypes;

use App\Cms\Core\Content;

class TextBlock
{
    public function __construct()
    {
        // ...
    }

    public function render($parentId)
    {
        $contents = Content::where('contentTypeSlug', 'textBlock')
            ->where('parentId', $parentId)
            ->get();

        if ($contents->isEmpty())
        {
            return false;
        }

        $contentString = $contents->first()->content;

        $prefix = '<div class="cms-content-wrapper" data-content-type="TextBlock">';
        $postfix = '</div>';

        $contentString = $prefix . $contentString . $postfix;

        return $contentString;
    }
}
