<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =['name', 'detail', 'address', 'start_date', 'end_date', 'status'];

    public function users(){

        return $this->belongsToMany(User::class)
                        ->withPivot('start')
                        ->wherePivot('end',null);
    }

    public function staff(){//use for project wise report

        return $this->belongsToMany(User::class)
                    ->withPivot('start','end');
    }



    public function user_relation(){

        return $this->belongsToMany(User::class)
        ->wherePivot('end',null);
    }
}
