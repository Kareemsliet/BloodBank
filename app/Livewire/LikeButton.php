<?php

namespace App\Livewire;

use Livewire\Component;

class LikeButton extends Component
{
    public $article_id;
    function mount($article_id){
         $this->article_id=$article_id;
    }

    function clickButton(){
        auth('clients')->user()->clientFavourites()->toggle($this->article_id);
    }

    public function render()
    {
        $color="gray";
        $article_favourite=auth('clients')->user()->clientFavourites()->where('articles.id','=',$this->article_id)->get();
        if(isset($article_favourite[0])){
            $color="red";
        }

        return view('livewire.like-button',['color'=>$color]);
    }
}
