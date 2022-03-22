<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDiscount extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded=[];

    public function discount()
    {
        return $this->belongsTo(Discount::class)->whereDate('end_date', '>=', Carbon::today()->toDateString());
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
