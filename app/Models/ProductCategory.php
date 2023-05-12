<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name','parrent_id','is_active'];
	protected $dates = ['created_at', 'updated_at'];

    public function parrent(){
        return $this->belongsTo(self::class,'parrent_id');
    }
}
