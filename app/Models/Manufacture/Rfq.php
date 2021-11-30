<?php

namespace App\Models\Manufacture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rfq extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mysql2';
    protected $guarded=[];

    public function images(){
        return $this->hasMany('App\Models\Manufacture\RfqImage','rfq_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\user', 'created_by', 'id');
    }

    public function bids()
    {
        return $this->hasMany('App\Models\Manufacture\SupplierBid', 'rfq_id')->withTrashed();
    }


}
