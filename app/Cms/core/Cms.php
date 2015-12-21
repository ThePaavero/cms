<?php

namespace App\Cms\Core;

use Illuminate\Support\Facades\App;

class Cms
{
    public function __construct()
    {
        // ...
    }

    public function processUri($uri)
    {
        $mapper = new UriMapper($uri);

        if ( ! $mappedPage = $mapper->getMappedPage())
        {
            App::abort(404);
        }

        dd($mappedPage);
    }
}
