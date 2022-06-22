<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
	protected $collection = 'products';

    protected $guarded=[];


}
