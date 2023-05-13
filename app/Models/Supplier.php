<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['name','business_name','registration_number','pan','email','mobile','address','country_id','state_id','city_id','postcode', 'is_active', 'created_by'];
	protected $dates = ['created_at', 'updated_at'];

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

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
