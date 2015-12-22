<?php

namespace App\Cms\Core;

use Illuminate\Database\Eloquent\Model;

class ContentHistory extends Model
{
    protected $table = 'content_history';

    public function __construct()
    {
        // ...
    }
}
