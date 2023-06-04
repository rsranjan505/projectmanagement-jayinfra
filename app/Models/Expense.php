<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = ['model_id','model_type','expanse_type_id','status','date','amount','description','checked_by','cancel_reason','is_active', 'created_by'];
	protected $dates = ['created_at', 'updated_at'];

    public function expanse_type(){
        return $this->belongsTo(ExpenseType::class,'expanse_type_id');
    }

    public function checkedby(){
        return $this->belongsTo(User::class,'checked_by');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function expensable()
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
    }

    public function image()
    {
        return $this->morphOne(AssetFile::class, 'pictureable','model_type', 'model_id');
    }
}
