<?php

namespace App\Models\Manufacture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierBid extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mysql2';
    protected $guarded=[];

    public function businessProfile(){
        return $this->belongsTo('App\Models\BusinessProfile', 'business_profile_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\Models\user', 'supplier_id', 'id');
    }

}
