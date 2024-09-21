<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    protected $table = 'states';
    public $timestamps = true;
    protected $fillable = array('name','code');

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    public function client_states()
    {
        return $this->belongsToMany('App\Models\Client');
    }
}
