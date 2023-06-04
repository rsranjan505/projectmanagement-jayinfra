<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPhase extends Model
{
    use HasFactory;
    protected $fillable = ['project_id','name','category','description','staff_id','start_date','deadline','duration','phase_extimated_cost','reason','project_status_id','is_active', 'created_by'];
	protected $dates = ['created_at', 'updated_at'];

    public function manager(){
        return $this->belongsTo(User::class,'staff_id');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }

    public function status(){
        return $this->belongsTo(ProjectStatus::class,'project_status_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

}
