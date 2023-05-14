<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }

    public function block()
    {
        return $this->hasMany(Block::class,'district_id','id')->where('is_active', 1)->orderBy('name');
    }
}
