<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Userchat extends Model
{
	protected $connection = 'mongodb';
    protected $collection = 'collection2';
    protected $fillable = ['participates','chatdata'];
}
