<?php

namespace App\Cms\ContentTypes;

use App\Cms\Core\Content;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;

class TextBlock
{
    public function __construct()
    {
        //Route::
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

        $prefix = '<div class="cms-content-wrapper" data-content-type="TextBlock" data-content-id="' . $contents->first()->id . '">';
        $postfix = '</div>';

        $contentString = $prefix . $contentString . $postfix;

        return $contentString;
    }

    public function handleActionSegments($segments)
    {
        return $this->$segments[0]($segments[1]);
    }

    public function updateContent($id)
    {
        $newContent = Input::get('newContent');

        $contentRow = Content::findOrFail($id);
        $contentRow->content = $newContent;
        $contentRow->save();

        return $contentRow->content;
    }
}
