<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Category extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatable = ['slug', 'name'];

    protected $fillable = ['slug', 'name'];

    public function posts()
    {
        return $this->hasMany(Post::class)
            ->where('status', 'PUBLISHED')
            ->orderBy('created_at', 'DESC');
    }

    public function parentId()
    {
        return $this->belongsTo(self::class);
    }
}
