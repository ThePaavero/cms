<?php

namespace App\Http\Controllers;

use App\Cms\Core\Cms;

class CmsController extends Controller
{
    public function __construct()
    {
        $this->cms = new Cms();
    }

    public function render($uri)
    {
        return $this->cms->processUri($uri);
    }
}
