<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $primaryKey = 'product_photo_id';
    protected $table = 'product_photos';
    protected $fillable = ['product_photo_id', 'thumbnail_photo_link', 'thumbnail_photo_name'];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo('App\ProductProductPhoto','product_photo_id');
    }
}
    