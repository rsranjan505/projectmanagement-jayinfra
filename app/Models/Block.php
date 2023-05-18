<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'district_id','code','is_active'];
	protected $dates = ['created_at', 'updated_at'];

    public function district()
    {
        return $this->belongsTo(District::class,'district_id','id');
    }

    public function panchayat()
    {
        return $this->hasMany(Panchayat::class,'block_id','id')->where('is_active', 1)->orderBy('name');
    }
}
