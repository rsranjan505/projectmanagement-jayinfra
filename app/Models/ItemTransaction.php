<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','model_type','model_id','type','quantity','unit_id','tax_rate_id','unit_amount','total_amount','cgst','sgst','igst','tax_amount','net_amount','is_active', 'created_by'];
	protected $dates = ['created_at', 'updated_at'];

    public function transacnable()
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function tax_rate()
    {
        return $this->belongsTo(TaxRate::class, 'tax_rate_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
}
