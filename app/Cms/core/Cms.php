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

        $contentTypeNames = $template->getContentAssociatedTypes();
        $contentTypesForTemplate = $this->getContentTypesByNames($contentTypeNames);

        $content = [];

        foreach ($contentTypesForTemplate as $contentType)
        {
            $content[$contentType['name']] = $this->renderContent($contentType, $mappedPage->id);
        }

        return view('cms::' . $templateSlug, [
            'data' => [
                'config' => $this->config,
                'title' => $mappedPage->title,
                'page' => $mappedPage->toArray(),
                'content' => $content,
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

    public function getContentTypesByNames($names)
    {
        $matches = [];

        foreach ($this->config['contentTypes'] as $name => $data)
        {
            if (in_array($name, $names))
            {
                $formatted = $data;
                $formatted['name'] = $name;
                $matches[] = $formatted;
            }
        }

        return $matches;
    }

    public function renderContent($contentType, $mappedPageId)
    {
        $contents = [];

        $contentTypeClass = 'App\\Cms\\ContentTypes\\' . $contentType['className'];
        if ( ! class_exists($contentTypeClass))
        {
            App::abort(500, 'No class for ContentType "' . $contentType['className'] . '"');
        }

        $contentTypeInstance = new $contentTypeClass();
        $contents[$contentType['slug']] = $contentTypeInstance->render($mappedPageId);

        return $contents;
    }
}
