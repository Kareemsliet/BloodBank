<?php

namespace App\Models;

use App\Notifications\ResetPassowrd;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;
    protected $table = 'clients';
    public $timestamps = true;

    protected $fillable = array('name', 'email', 'phone', 'password', 'city_id', 'birth_date', 'last_donate_date', 'blood_type_id', 'pin_code');

    protected $hidden = ['password', 'pin_code'];

   

    public function blood_type()
    {
        return $this->belongsTo('App\Models\BloodType');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function donations()
    {
        return $this->hasMany('App\Models\Donate');
    }

    public function clientNotifications()
    {
        return $this->belongsToMany('App\Models\Notification', "client_notification");
        ;
    }

    public function clientFavourites()
    {
        return $this->belongsToMany('App\Models\Article', "client_favourite");
    }

    public function clientStates()
    {
        return $this->belongsToMany('App\Models\State');
    }

    public function clientBloodTypes()
    {
        return $this->belongsToMany('App\Models\BloodType', "client_blood_type");
    }

    public function routeNotificationForVonage(ResetPassowrd $notification): string
    {
        return '2' . $this->phone;
    }
}
