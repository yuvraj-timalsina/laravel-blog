<?php

namespace App\Http\Traits;

use App\Models\Category;

trait FetchCategory
{
     public function fetchCategory($order = 'ASC')
     {
          return Category::orderBy('name', $order)
               ->select('id', 'name')->get();
     }
}