<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductWishlist extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
