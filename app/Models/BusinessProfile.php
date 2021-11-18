<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProfile extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function companyOverview()
    {
        return $this->hasOne(CompanyOverview::class);
    }
    public function machineriesDetails()
    {
        return $this->hasMany(MachineriesDetail::class);
    }
    public function categoriesProduceds()
    {
        return $this->hasMany(CategoriesProduced::class);
    }
    public function productionCapacities()
    {
        return $this->hasMany(ProductionCapacity::class);
    }
    public function productionFlowAndManpowers()
    {
        return $this->hasMany(ProductionFlowAndManpower::class);
    }

}
