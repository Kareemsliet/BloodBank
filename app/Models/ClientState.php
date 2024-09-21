<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientState extends Model 
{

    protected $table = 'client_states';
    public $timestamps = true;
    protected $fillable = array('state_id', 'client_id');

}