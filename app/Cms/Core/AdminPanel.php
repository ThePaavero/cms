<?php

namespace App\Cms\Core;

class AdminPanel
{
    public function __construct($tree, $modules)
    {
        $this->tree = $tree;
        $this->modules = $modules;
    }

    public function renderPanel()
    {
        $data = [];

        foreach ($this->modules as $moduleName => $moduleInstance)
        {
            $data['controls'][$moduleName] = $moduleInstance->getMenuMarkup();
        }

        return view('cmsAdmin::panel', ['data' => $data]);
    }

}
