<?php

namespace App\Cms\Core;

class Template
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function viewFileExists()
    {
        $fileName = $this->data['slug'] . '.blade.php';
        $templateFilePath = __DIR__ . '/../Templates/' . $fileName;

        return file_exists($templateFilePath);
    }

    public function getContentAssociatedTypes()
    {
        return $this->data['contentTypes'];
    }
}
