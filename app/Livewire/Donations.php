<?php

namespace App\Livewire;

use App\Models\BloodType;
use App\Models\Donate;
use App\Models\State;
use Livewire\Component;

class Donations extends Component
{

    public $state_id;
    public $blood_type_id;

    function getDonations(){
        if($this->state_id && $this->blood_type_id){
            $donations=Donate::select('*')->whereHas('city',function($query){
                $query->where('cities.state_id','=',$this->state_id);
            })->whereHas('bloodTypes',function($query){
                $query->where('blood_types.id','=',$this->blood_type_id);
            })->orderByDesc('donations.created_at')->limit(5)->get();
        }else if ($this->state_id) {
            $donations=Donate::select('*')->whereHas('city',function($query){
                $query->where('cities.state_id','=',$this->state_id);
            })->orderByDesc('donations.created_at')->limit(5)->get();
        }else if($this->blood_type_id){
            $donations=Donate::select('*')->whereHas('bloodTypes',function($query){
             $query->where('blood_types.id','=',$this->blood_type_id);
            })->orderByDesc('donations.created_at')->limit(5)->get();
        }else{
            $donations=Donate::select('*')->orderByDesc('created_at')->limit(5)->get();
        }

        return $donations;

    }
    public function render()
    {
        $blood_types=BloodType::all();
        $states=State::all();

        $donations=$this->getDonations();

        return view('livewire.donations',['blood_types'=>$blood_types,'states'=>$states,'donations'=>$donations]);
    }
}
