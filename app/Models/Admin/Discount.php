<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];
    protected $casts = [
        'business_profile_id' => 'array',
    ];


    public function product_discount()
    {
        return $this->hasMany(ProductDiscount::class);
    }
}
