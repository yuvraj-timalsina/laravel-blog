<?php

namespace App\Http\Traits;

use App\Models\Tag;

trait FetchTag
{
     public function fetchTag($order = 'ASC')
     {
          return Tag::orderBy('name', $order)->select('id', 'name')->get();
     }
}
