<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name','state_id');

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public function client()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function donations()
    {
        return $this->hasMany('App\Models\Donate');
    }

}
