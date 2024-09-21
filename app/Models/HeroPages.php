<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroPages extends Model 
{

    protected $table = 'hero_pages';
    public $timestamps = true;
    protected $fillable = array('image', 'des', 'title');

}