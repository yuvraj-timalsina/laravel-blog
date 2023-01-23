<?php

namespace App\Http\Traits;

use App\Models\Post;

trait FetchTrashPost
{
     public function fetchTrashPost($id)
     {
          return Post::withTrashed()->findOrFail($id);
     }
}