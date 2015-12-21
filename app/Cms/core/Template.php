<?php

namespace App\Cms\Core;

class Template
{
    public function __construct($slug)
    {
        $this->slug = $slug;
    }

    public function slugMapsToFile()
    {
        $fileName = $this->slug . '.blade.php';
        $templateFilePath = __DIR__ . '/../Templates/' . $fileName;

        return file_exists($templateFilePath);
    }
}
