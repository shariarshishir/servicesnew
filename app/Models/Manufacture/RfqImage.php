<?php

namespace App\Models\Manufacture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfqImage extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $guarded=[];
}
