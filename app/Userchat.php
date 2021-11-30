<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Userchat extends Model
{
	protected $connection = 'mongodb';
    protected $collection = 'chatdata';
    protected $fillable = ['participates','chatdata'];
}
