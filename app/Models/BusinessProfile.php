<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProfile extends Model
{
    use HasFactory;
    protected $guarded=[];

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
    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }
    public function mainBuyers()
    {
        return $this->hasMany(MainBuyer::class);
    }
    public function exportDestinations()
    {
        return $this->hasMany(ExportDestination::class);
    }
    public function associationMemberships()
    {
        return $this->hasMany(AssociationMembership::class);
    }
    public function pressHighlights()
    {
        return $this->hasMany(PressHighlight::class);
    }

    public function businessTerms()
    {
        return $this->hasMany(BusinessTerm::class);
    }
    public function samplings()
    {
        return $this->hasMany(Sampling::class);
    }
    public function specialCustomizations()
    {
        return $this->hasMany(SpecialCustomization::class);
    }
    public function sustainabilityCommitments()
    {
        return $this->hasMany(SustainabilityCommitment::class);
    }
    public function walfare()
    {
        return $this->hasOne(Walfare::class);
    }
    public function security()
    {
        return $this->hasOne(Security::class);
    }
    

}
