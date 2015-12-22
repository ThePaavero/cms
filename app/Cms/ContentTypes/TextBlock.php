<?php

namespace App\Cms\ContentTypes;

use App\Cms\Core\Content;
use App\Cms\Core\ContentHistory;
use Illuminate\Support\Facades\Input;

class TextBlock
{
    public function __construct($adminMode = false)
    {
        $this->adminMode = $adminMode;
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

        if ($this->adminMode)
        {
            $prefix = '<div class="cms-content-wrapper" data-content-type="TextBlock" data-content-id="' . $contents->first()->id . '">';
        }
        else
        {
            $prefix = '<div class="cms-content-wrapper text-block">';
        }

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

        // Create history backup
        $backup = new ContentHistory();
        $backup->content = $contentRow->content;
        $backup->originalId = $id;
        $backup->contentTypeSlug = $contentRow->contentTypeSlug;
        $backup->parentId = $contentRow->parentId;
        $backup->save();

        $contentRow->content = $newContent;
        $contentRow->save();

        return $contentRow->content;
    }
}
