<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = ['name','table_name','parrent_id', 'is_active'];
	protected $dates = ['created_at', 'updated_at'];
}
