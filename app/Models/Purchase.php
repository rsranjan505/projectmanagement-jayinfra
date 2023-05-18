<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['supplier_id','invoice_number','invoice_date','amount','shipping_charge','tax_amount','invoice_amount','is_active', 'created_by'];
	protected $dates = ['created_at', 'updated_at'];

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

}
