<?php

namespace App\Models\Manufacture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $guarded=[];
    protected $casts=[
        'product_image'=>'array',
        'colors'=>'array',
        'sizes'=>'array',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\\Manufacture\ProductCategory','product_category');
    }

    public function product_images(){
        return $this->hasMany('App\Models\\Manufacture\ProductImage','product_id');
    }
}
