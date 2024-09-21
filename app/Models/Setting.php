<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('name', 'logo', 'email', 'phone', 'description', 'adress','facebook_link', 'twitter_link', 'youtube_link');

}
