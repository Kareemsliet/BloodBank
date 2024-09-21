<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $table = 'articles';
    public $timestamps = true;
    protected $fillable = array('title', 'description', 'image','cat_id');

    public function client_favourites()
    {
        return $this->belongsToMany('App\Models\Client',"client_favourite");
    }

    function category(){
        return $this->belongsTo(Category::class,'cat_id');
    }

}
