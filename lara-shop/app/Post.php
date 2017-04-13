<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';
    protected $fillable = [
        'author_id','category_id','banner','title','body','slug','active'
    ];
//    protected $primaryKey = 'id';

    public function user() {
        return $this->belongsTo('App\User', 'author_id','id');
    }
    public function cateblog(){
        return $this->belongsTo('App\Cateblog','category_id','id');
    }
    public function comments(){
        return $this->hasMany('App\Comment','on_post');
    }
}
