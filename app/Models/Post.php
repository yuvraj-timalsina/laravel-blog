<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $fillable = ['title', 'content', 'featured_image', 'category_id', 'user_id'];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    /**
     * Delete post image from Storage.
     *
     * @return void
     */
    public function deleteImage()
    {
        Storage::delete($this->featured_image);
    }
    /**
     * Return name in array.
     *
     * @param [type] $name
     * @return boolean
     */
    public function hasTag($name)
    {
        return in_array($name, $this->tags->pluck('name')->toArray());
    }
}