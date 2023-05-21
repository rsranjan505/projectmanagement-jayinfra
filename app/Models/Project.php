<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name','short_desc','staff_id','long_desc','project_type','start_date','deadline','duration','project_extimated_cost','client_id','project_status_id','is_active', 'created_by'];
	protected $dates = ['created_at', 'updated_at'];

    public function manager(){
        return $this->belongsTo(User::class,'staff_id');
    }

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }

    public function status(){
        return $this->belongsTo(ProjectStatus::class,'project_status_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

}
