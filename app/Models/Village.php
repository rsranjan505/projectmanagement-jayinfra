<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'panchayat_id','code','is_active'];
	protected $dates = ['created_at', 'updated_at'];

    public function panchayat()
    {
        return $this->belongsTo(Panchayat::class,'panchayat_id','id');
    }
}
