<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'category_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class , 'category_id');
    }

    public function getParentName()
    {
        return is_null($this->parent)
            ? 'ندارد'
            : $this->parent->name;
    }

    public function children()
    {
        return $this->hasMany(Category::class , 'category_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
