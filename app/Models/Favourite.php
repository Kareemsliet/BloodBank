<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model 
{

    protected $table = 'client_favourites';
    public $timestamps = true;
    protected $fillable = array('client_id', 'article_id');

}