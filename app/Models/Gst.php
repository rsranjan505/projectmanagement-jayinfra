<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gst extends Model
{
    use HasFactory;
    protected $fillable = ['model_id','model_type','gstin','is_primary','address','country_id','state_id','city_id','postcode', 'is_active'];
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

    public function gstable()
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
    }
}
