<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table='catalogs';
    protected $fillable=['name'];
    protected $primaryKey = 'catalog_id';

    public $timestamps=false;
    public function products(){
        return $this->hasMany('App\Product','catalog_id');
    }
    public function getFeatureProducts(){
        return $this->products()->take(4)->get();
    }
}
