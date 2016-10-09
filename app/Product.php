<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\ProductProductPhoto;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'id', 'catalog_id', 'product_name', 'price', 'description', 'brand', 'status'
    ];


    public function product_product_photos()
    {
        return $this->hasMany('App\ProductProductPhoto');
    }

    public function getImageFeature()
    {
        $product_product_photo = $this->product_product_photos()->first(); // lay cai product_product dau tin ma no co

//        return $product_product_photo;
       if($product_product_photo !== null){
           $image = $product_product_photo->product_image()->first(); // lay cai anh day
           return $image->thumbnail_photo_link;
       }
        return 'noimage.jpg';

    }


}
