<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';
    protected $fillable = [
      'on_post','from_user','body'
    ];
    protected $primaryKey = 'id';

    public function post() {
        return $this->belongsTo('App\Post', 'on_post');
    }

    public function user() {
        return $this->belongsTo('App\User', 'from_user');
    }
}
