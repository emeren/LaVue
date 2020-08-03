<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'parent_id', 'published'
    ];
    protected $table = 'categories';

    /**
     * Get the posts.
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    /**
     * Category has parents
     *
     * @return void
     */
    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    /**
     * Category has children
     *
     * @return void
     */

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id')->with('children');
    }
}
