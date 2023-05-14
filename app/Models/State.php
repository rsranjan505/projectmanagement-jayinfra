<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'country_id'];
	protected $dates = ['created_at', 'updated_at'];

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function district()
    {
        return $this->hasMany(District::class,'state_id')->where('is_active', 1)->orderBy('name');
    }
}
