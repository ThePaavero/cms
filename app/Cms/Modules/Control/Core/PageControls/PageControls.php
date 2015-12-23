<?php

namespace App\Cms\Modules\Control\Core\PageControls;

use Illuminate\Support\Facades\View;

class PageControls
{
    public $currentPageObject;

    public function __construct($currentPageObject)
    {
        $this->currentPageObject = $currentPageObject;
        View::addNamespace('pageControls', __DIR__ . '/views');
    }

    public function getMenuMarkup()
    {
        $data = [
            'pageId' => $this->currentPageObject->id
        ];

        return view('pageControls::panel_menu', ['data' => $data]);
    }
}
