<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donate extends Model
{

    protected $table = 'donations';
    public $timestamps = true;
    protected $fillable = array('name', 'age', 'blood_type_id', 'city_id', 'phone', 'description', 'hospital_adress', 'num_bags', 'client_id', 'latitude', 'longitude');

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function bloodTypes(){
        return $this->belongsTo(BloodType::class,'blood_type_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification','donation_id');
    }

}
