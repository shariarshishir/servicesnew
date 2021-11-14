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

}
