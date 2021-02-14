<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;


class Task extends Model
{
    use Commentable;
    protected $dates = ['created_at', 'updated_at', 'deadline'];
    protected $fillable = ['title', 'completed', 'deadline', 'description', 'user_id', 'posted_user_id', 'priority'];
    public function User()
    {
        return $this->belongsTo('App\User', 'posted_user_id');
    }
    public function Assigned()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
