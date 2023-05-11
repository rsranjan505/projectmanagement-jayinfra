<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    use HasFactory;
    protected $fillable = ['name','sku', 'is_active'];
	protected $dates = ['created_at', 'updated_at'];

}