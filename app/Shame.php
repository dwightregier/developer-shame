<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed markdown
 * @property mixed user_id
 * @property mixed title
 * @property mixed is_anonymous
 */
class Shame extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'markdown', 'is_anonymous'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_anonymous' => 'boolean'
    ];

    /**
     * The tags that belong to this shame.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
