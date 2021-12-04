<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $guarded=[];
    public function businessProfile()
    {
        return $this->belongsTo(BusinessProfile::class,'business_profile_id');
    }
}
