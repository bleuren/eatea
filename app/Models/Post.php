<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class Post extends Model
{
    use HasFactory, Translatable, Resizable;

    protected $translatable = ['title', 'slug', 'seo_title', 'excerpt', 'body', 'meta_description', 'meta_keywords'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
