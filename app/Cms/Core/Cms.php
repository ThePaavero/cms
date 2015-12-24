<?php

namespace App\Cms\Core;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Cms
{
    public $currentPageId;
    public $currentPageObject;
    public $adminPanelMarkup;
    public $sitemap;
    public $tree;
    public $modules;

    public function __construct()
    {
        $this->config = include __DIR__ . '/../Config/cms.php';

        $this->sitemap = new Sitemap();
        $this->tree = $this->sitemap->getNestedArrayOfAllPages();

        $templateViewDir = __DIR__ . '/../Templates';
        $adminViewDir = __DIR__ . '/../Views';

        View::addNamespace('cms', $templateViewDir);
        View::addNamespace('cmsAdmin', $adminViewDir);
    }

    public function processUri($uri)
    {
        if (explode('/', $uri)[0] === 'admin')
        {
            $segments = explode('/', $uri);
            array_shift($segments);

            return $this->processAdminUri($segments);
        }

        $mapper = new UriMapper($uri);

        if ( ! $mappedPage = $mapper->getMappedPage())
        {
            App::abort(404);
        }

        $this->currentPageId = $mappedPage->id;
        $this->currentPageObject = $mappedPage;

        $this->modules = $this->bootAvailableModules();

        $panel = new AdminPanel($this->tree, $this->modules);
        $this->adminPanelMarkup = $panel->renderPanel();

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

        $this->pageContent = $content;

        return view('cms::' . $templateSlug, [
            'data' => [
                'config' => $this->config,
                'title' => $mappedPage->title,
                'page' => $mappedPage->toArray(),
                'content' => $content,
                'contentTypesForTemplate' => $contentTypesForTemplate
            ],
            'cms' => $this,
            'userIsAdmin' => Auth::user() ? true : false
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

        $contentTypeInstance = new $contentTypeClass($this->userIsAdmin());
        $renderedContent = $contentTypeInstance->render($mappedPageId);

        if ($renderedContent === false)
        {
            // Create placeholder content
            $this->createPlaceholderContent($mappedPageId, $contentType);

            // Let's try this again
            $renderedContent = $contentTypeInstance->render($mappedPageId);
        }

        return $renderedContent;
    }

    public function render($type)
    {
        if ( ! isset($this->pageContent[$type]))
        {
            App::abort(500, 'ContentType "' . $type . '" did not have any rendered content.');
        }

        return $this->pageContent[$type];
    }

    public function createPlaceholderContent($pageId, $contentType)
    {
        $content = new Content();
        $content->content = $contentType['placeholder'];
        $content->contentTypeSlug = $contentType['name'];
        $content->parentId = $pageId;
        $content->save();
    }

    public function processAdminUri($segments)
    {
        if ($segments[0] === 'contentType')
        {
            array_shift($segments);
            $contentTypeClass = 'App\\Cms\\ContentTypes\\' . $segments[0];
            if ( ! class_exists($contentTypeClass))
            {
                App::abort(500, 'No class for ContentType "' . $contentTypeClass . '"');
            }

            $contentTypeInstance = new $contentTypeClass();
            array_shift($segments);

            return $contentTypeInstance->handleActionSegments($segments);
        }
    }

    public function userIsAdmin()
    {
        return ! is_null(Auth::user());
    }

    public function getAdminPanel()
    {
        return $this->userIsAdmin() ? $this->adminPanelMarkup : '';
    }

    public function getCompleteSiteMapAsNavigation()
    {
        $navigation = new Navigation($this->tree);

        return $navigation->renderNestedList();
    }

    public function bootAvailableModules()
    {
        $currentPageObject = $this->currentPageObject;

        $instances = [];

        $coreControlModules = [
            'PageControls'
        ];

        foreach ($coreControlModules as $moduleName)
        {
            $completeClassPath = 'App\\Cms\\Modules\\Control\\Core\\PageControls\\' . $moduleName;
            $instance = new $completeClassPath($currentPageObject);

            $instances[$moduleName] = $instance;
        }

        return $instances;
    }
}
