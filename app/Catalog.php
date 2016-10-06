<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table='catalogs';
    protected $fillable=['name'];

    public $timestamps=false;
}
