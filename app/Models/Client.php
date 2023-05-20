<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name','business_name','type','email','mobile','address','state_id','city_id','postcode', 'is_active', 'created_by'];
	protected $dates = ['created_at', 'updated_at'];


    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function gst()
    {
        return $this->morphOne(Gst::class, 'gstable','model_type', 'model_id');
    }
}
