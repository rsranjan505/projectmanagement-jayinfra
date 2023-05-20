<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','quantity', 'unit_id','is_active'];
	protected $dates = ['created_at', 'updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class,'unit_id','id');
    }
}
