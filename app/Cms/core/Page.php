<?php

namespace App\Cms\Core;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function __construct()
    {
        // ...
    }

    public function template()
    {
        return $this->belongsTo('App\Cms\Core\Template');
    }
}
