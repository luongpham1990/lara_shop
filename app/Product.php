<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    protected $fillable = [
        'id','catalog_id','product_name', 'price', 'description','brand','status'
    ];
}
