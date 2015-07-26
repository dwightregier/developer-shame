<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function shame()
    {
        return $this->belongsTo('App\Shame');
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', '=', '0');
    }

    public function url()
    {
        if ($this->type === 'Shame') {
            $url = route('shames.show', ['id' => $this->shame_id]) . '?notification=' . $this->id;
        } else if ($this->type === 'Comment') {
            $url = route('shames.show', ['id' => $this->shame_id]) . '?notification=' . $this->id . '#' . $this->comment_id;
        } else { // Badge
            $url = route('profile') . '?notification=' . $this->id;
        }

        return $url;
    }

    public function icon()
    {
        if ($this->type === 'Shame') {
            $icon = 'fa-code';
        } else if ($this->type === 'Comment') {
            $icon = 'fa-comment';
        } else {
            $icon = 'fa-certificate';
        }

        return $icon;
    }

    public function body()
    {
        if ($this->type === 'Shame') {
            $body = 'A shame you were following titled: <strong>' . htmlentities($this->shame->title) . '</strong> has been edited';
        } else if ($this->type === 'Comment') {
            $body = 'A shame you were following titled: <strong>' . htmlentities($this->shame->title) . '</strong> has received a comment';
        } else {
            $body = 'You have earned a new badge';
        }

        return $body;
    }
}
