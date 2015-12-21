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
        $templateData = $this->getTemplateDataBySlug($templateSlug);

        $template = $template = new Template($templateData);

        if ( ! $template->viewFileExists())
        {
            App::abort(500, 'Template file missing (' . $templateSlug . ').');
        }

        $contentTypesForTemplate = $template->getContentAssociatedTypes();

        return view('cms::' . $templateSlug, [
            'data' => [
                'config' => $this->config,
                'contentTypesForTemplate' => $contentTypesForTemplate
            ]
        ]);
    }

    public function getTemplateDataBySlug($templateSlug)
    {
        foreach ($this->config['templates'] as $name => $data)
        {
            if ($data['slug'] === $templateSlug)
            {
                $data['name'] = $name;
                return $data;
            }
        }
    }
}
