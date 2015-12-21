<?php

namespace App\Cms\Core;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class Cms
{
    public function __construct()
    {
        $this->config = include __DIR__ . '/../Config/cms.php';

        $viewDir = __DIR__ . '/../Templates';
        View::addNamespace('cms', $viewDir);
    }

    public function processUri($uri)
    {
        $mapper = new UriMapper($uri);

        if ( ! $mappedPage = $mapper->getMappedPage())
        {
            App::abort(404);
        }

        $templateSlug = $mappedPage->templateSlug;

        $template = $template = new Template($templateSlug);

        if ( ! $template->slugMapsToFile())
        {
            App::abort(500, 'Template file missing (' . $templateSlug . ').');
        }

        return view('cms::' . $templateSlug, []);
    }
}
