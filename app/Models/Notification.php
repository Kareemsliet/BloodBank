<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('id', 'title', 'description', 'donation_id');

    public function donations()
    {
        return $this->belongsTo('App\Models\Donate','donation_id');
    }

    public function client()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}
