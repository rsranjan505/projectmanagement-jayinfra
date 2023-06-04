<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLocation extends Model
{
    use HasFactory;
    protected $fillable = ['project_id','is_primary','project_phase_id','address','state_id','district_id','block_id','panchayat_id','village_id','is_active', 'created_by'];
	protected $dates = ['created_at', 'updated_at'];

    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }

    public function project_phase(){
        return $this->belongsTo(ProjectPhase::class,'project_phase_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
}
