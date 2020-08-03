<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Category;

class Post extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'user_id', 'thumbnail', 'gallery', 'publish_from', 'publish_to', 'published'
    ];

    /**
     * post belongs to user
     *
     * @var array
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get the category.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_post', 'post_id', 'category_id');
    }
}
