<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectUser;

use Illuminate\Database\Eloquent\Builder;


use Inertia\Inertia;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->user_type =='worker'){
            return redirect()->route('work.log');
        }
       $project =  Project::whereStatus(1)
                    ->has('employee')
                    ->with('employee:id,first_name,last_name,user_type,photo_path')
                    ->get();

        // $worker = User::select(['id','first_name','last_name','photo_path','email','mobile'])->where('user_type','worker');
        // $manager = User::select(['id','first_name','last_name','photo_path','email','mobile'])->where('user_type','manager');
        // $data['project_count'] = Project::count();
        // $data['project_data'] = Project::select(['id','name','address','start_date','end_date','status'])
        // //->with('user') Tanisha@22B><
        // ->withCount(['staff as worker_count'=>function(Builder $query){
        //     $query->where('user_type','worker');
        // }, 'staff as manager_count'=>function(Builder $query){
        //     $query->where('user_type','manager');
        // }])
        // ->orderBy('id','desc')->take(5)->get();

        // // dd($data['project_data']->toArray());
        // $data['manager_count']=  $manager->count();
        // $data['manager_data']=  $manager->with('staff_availablity:id')->take(5)->get();

        // $data['worker_count']= $worker->count();
        // $data['worker_data'] = $worker->with('staff_availablity:id')->take(5)->get();

        return Inertia::render('Dashboard/Index',['projects'=>$project]);//, 'data'=>$data]);
    }

    protected function project_user_type_count($project_id){

        return ProjectUser::whereIn('project_id',$project_id)
                            ->whereEnd(null)
                           // ->withCount(['worker_user','manager_user'])
                            ->get();

    }
}
