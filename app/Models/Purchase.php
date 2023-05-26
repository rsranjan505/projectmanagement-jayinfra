<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['supplier_id','invoice_number','invoice_date','payment_mode','amount','shipping_charge','tax_amount','invoice_amount','bill_note','is_draft','is_active', 'created_by'];
	protected $dates = ['created_at', 'updated_at'];

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function transectionItem()
    {
        return $this->morphMany(ItemTransaction::class, 'transacnable','model_type', 'model_id');
    }

}
