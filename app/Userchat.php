<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Userchat extends Model
{
	protected $connection = 'mongodb';
    protected $collection = 'b2bmsgcollection';
    protected $fillable = ['participates','chatdata'];
}
