<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id','brand_id','modelo_id','um_id','currency_id','typeproduct','purchaseprice','saleprice','salepricemin','stock','stockmin',
        'state','name','description','image','prodservicio','codigo'
    ];


    const PRODUCTO = 1;
    const SERVICIO = 2;
    const NUEVO = 1;
    const USADO = 2;

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = str::slug($name);
    }

}
