<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyFactoryTour extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='company_factory_tour';
    public function businessProfile()
    {
        return $this->belongsTo(BusinessProfile::class);
    }
}
