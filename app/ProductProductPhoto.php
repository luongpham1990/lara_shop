<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductProductPhoto extends Model
{
    //
    protected $table = 'product_product_photos';
    public $timestamps = false;

    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
    public function product_image(){
        return $this->hasOne('App\ProductImages','product_photo_id', 'product_photo_id');
    }

    public function getAllImage(){
        $imgs = DB::table('product_photos')->select('product_photos.thumbnail_photo_link')
            ->join('product_product_photos', 'product_photos.product_photo_id', '=', 'product_product_photos.product_photo_id')
            ->join('products', 'product_product_photos.product_id', '=', 'products.id')
            ->get();
         $imgs[0]->thumbnail_photo_link;
    }

}
