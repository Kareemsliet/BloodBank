?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientBlood extends Model
{
    protected $table = 'client_blood_types';
    public $timestamps = true;
    protected $fillable = array('blood_type_id', 'client_id');
}
