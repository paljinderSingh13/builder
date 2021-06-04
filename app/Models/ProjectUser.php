<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class ProjectUser extends Model
{
    use HasFactory;
    public $table = 'project_user';





    public function user(){
        return $this->belongsTo(User::class);
    }

    public function worker_user(){
        return $this->belongsTo(User::class,'user_id', 'id')->where('user_type', 'worker');
    }



    public function project(){
        return $this->belongsTo(Project::class);
    }

}
