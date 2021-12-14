<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufactureProductVideo extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    // public function product()
    // {
    //     return $this->belongsTo('App\Models\Manufacture\Product','product_id');
    // }
}
