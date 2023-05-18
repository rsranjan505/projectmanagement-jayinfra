<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panchayat extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'block_id','code','is_active'];
	protected $dates = ['created_at', 'updated_at'];

    public function block()
    {
        return $this->belongsTo(Block::class,'block_id','id');
    }

    public function village()
    {
        return $this->hasMany(Village::class,'panchayat_id')->where('is_active', 1)->orderBy('name');
    }
}
