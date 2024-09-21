<?php

namespace App\Livewire;

use App\Models\BloodType;
use App\Models\State;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Settings extends Component
{

    public $statesIds=[];
    public $blood_typesIds=[];

    function check(){

        $client=auth('clients')->user();

         $this->statesIds=$client->clientStates()->pluck('states.id')->toArray();

        $this->blood_typesIds=$client->clientBloodTypes()->pluck('blood_types.id')->toArray();

    }

    function change(){

        $client=auth('clients')->user();

        $client->clientStates()->sync($this->statesIds);

        $client->clientBloodTypes()->sync($this->blood_typesIds);

    }

    public function render()
    {

        $states=State::all();

        $blood_types=BloodType::all();

        $this->check();

        return view('livewire.settings',['states'=>$states,'blood_types'=>$blood_types]);
    }

}
