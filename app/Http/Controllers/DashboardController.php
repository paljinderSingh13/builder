<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\User;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $worker = User::select(['id','first_name','last_name','photo_path'])->where('user_type','worker');
        $manager = User::select(['id','first_name','last_name','photo_path'])->where('user_type','manager');
        $data['project_count'] = Project::count();
        $data['project_data'] = Project::select(['id','name','address','start_date','end_date','status'])->orderBy('id','desc')->take(5)->get();

        $data['manager_count']=  $manager->count();
        $data['manager_data']=  $manager->with('staff_availablity:id')->take(5)->get();

        $data['worker_count']= $worker->count();
        $data['worker_data'] = $worker->with('staff_availablity:id')->take(5)->get();

        return Inertia::render('Dashboard/Index',['data'=>$data]);
    }
}
