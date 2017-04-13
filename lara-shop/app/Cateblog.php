<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cateblog extends Model
{
    //
    protected $table = 'cateblogs';
    protected $fillable = [
        'name','slug','description','image',
    ];
//    protected $primaryKey = 'id';

    public function post() {
        return $this->hasMany('App\Post');
    }
}
