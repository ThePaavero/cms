<?php

namespace App\Cms\Core;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function __construct()
    {
        // ...
    }

    public function getContentForContentTypeAndPage($contentTypeSlug, $pageId)
    {
        // ...
    }
}
