<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectUser;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;


use Inertia\Inertia;


class ProjectController extends Controller
{

    public function index(){

        $data = Project::all();
        return Inertia::render('Projects/Index',['data'=>$data->toArray()]);

    }

    public function create(){

        return Inertia::render('Projects/Create');
    }

    public function store(){

        Request::validate([
            'name' => ['required', 'max:50'],
        ]);

        $model = new Project();
        $model->fill(Request::all());
        $model->save();
        return Redirect::route('projects')->with('success', 'Project Added Successful.');

    }

    public function edit($id){

        $project = Project::where('id',$id)->withTrashed()->first();
        $data = $project->toArray();
       return Inertia::render('Projects/Edit',['data'=>$data]);
    }

    public function update(Project $project)
    {
        Request::validate([
            'name' => ['required', 'max:50'],
        ]);

        $project->update(Request::only('name', 'detail', 'address', 'start_date', 'end_date', 'status'));
        return Redirect::back()->with('success', 'Project Updated Successfully.');
    }


    public function destroy(Project $project){

        $project->delete();

        return Redirect::back()->with('success', 'Project Deleted Successfully.');

    }

    public function restore($id)
    {
        Project::whereId($id)->restore();
        return Redirect::back()->with('success', 'Project Restored Successfully.');
    }

    public function manage_team($project_id ){

        $project = Project::with('users')->whereId($project_id)->first();

       $exist_team = $project->users->pluck('id')->toArray();

       // dd($project->toArray());
      $occupied_worker = ProjectUser::whereHas('user',function($q){
          $q->where('user_type','worker');
      })->where('end',null)->pluck('user_id');

    //    dd($project_user->toArray());
        $user = User::whereIn('user_type',['manager','worker'])->get()->groupBy('user_type');


    //    dd($project->toArray() , $user->toArray());

        return Inertia::render('Projects/Team',['occupied_worker'=>$occupied_worker , 'exist_team'=> $exist_team, 'project'=>$project, 'user'=>$user]);


    }



    public function sync_team(){

        $project = Project::find(Request::get('project_id'));

        if(Request::get('type') == 'in'){
            $project->users()->attach(Request::get('team'),['start'=>date('Y-m-d h:m')]);
        }
        else{
            $project->users()->updateExistingPivot(Request::get('team'),['end'=>date('Y-m-d h:m')]);
        }

       // (Request::get('type') == 'in')?$type="Add":$type="Remove";

        return Redirect::back();//->with('success', "Successfully $type Team Member.");

    }

    public function status($project, $status){

        //dd($project, $status);

        Project::whereId($project)->update(['status'=>($status==1?0:1)]);
        return back();

    }




}
