<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['text'];

    /**
     * The user who posted the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The shame this comment was posted on.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shame()
    {
        return $this->belongsTo('App\Shame');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function upvotes()
    {
        return $this->belongsToMany('App\User','upvote_comment','comment_id','user_id');
    }
}
