<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('name');

    public function client()
    {
        return $this->hasMany('App\Models\Client');
    }

    function donations(){
        return $this->hasMany(Donate::class,'blood_type_id');
    }
    public function clientBloodType()
    {
        return $this->belongsToMany('App\Models\Client');
    }


}
