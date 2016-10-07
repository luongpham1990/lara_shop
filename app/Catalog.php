<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table='catalogs';
    protected $fillable=['name'];
    protected $primaryKey = 'catalog_id';

    public $timestamps=false;
}
