<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleSetting extends Model
{
    use HasFactory;
    protected $fillable = ['module_id','column_setting'];
	protected $dates = ['created_at', 'updated_at'];
}
