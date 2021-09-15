<?php

namespace App\Http\Controllers;
use App\Models\ProjectUser;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;
use Auth;
class ReportsController extends Controller
{

    public function work_log(){

         $user = Auth::user();

        if($user->user_type !='admin'){
            $logs = ProjectUser::whereUserId($user->id)->get();//->groupBy('project_id');
            $pid =  $logs->pluck('project_id')->unique();
            $projects = Project::whereIn('id',$pid)->pluck('name','id');
            // if($user->user_type =='manager'){
                return Inertia::render('Reports/WorkLog',['logs'=>$logs->groupBy('project_id'),'projects'=> $projects ] );
            // }else{
            //     return Inertia::render('Reports/WorkerLog',['logs'=>$logs->groupBy('project_id'),'projects'=> $projects ] );
            // }
        }else{
            return Inertia::render('Reports/Norecord');
        }
    }


    public function index(Request $request)
    {
        if($request->isMethod('post')){
            $date  = $request->date;
        }else{
            $date  = date('Y-m-d');
        }

        if($date  > date('Y-m-d')){
            return back()->with('error', 'Date must be less than from curremt date.');
        }

        $data = ProjectUser::select(['id','user_id','project_id','start','end'])
                            ->has('user')
                            ->with('user:id,first_name,last_name,photo_path,user_type','project:id,name')
                            ->whereDate('start','<=',$date)
                            ->Where(function($query)use($date){
                                $query->orWhere('end',null)
                                ->orWhereDate('end','>=',$date);
                            })
                            ->get()
                           ->groupBy(['user.user_type','user_id']);

         // dd($data->toArray());

        return Inertia::render('Reports/Index',['data'=>$data->toArray(), 'date'=>$date]);
    }

     // $n = User::whereHas('pivotss', function (Builder $query)use($date){
        //             $query->whereDate('start','<=',$date)
        //                      ->where( function($q)use($date){
        //                         $q->orWhere('end',null)
        //                         ->whereDate('end','>=',$date);

        //                      });
        //                 })->with('pivotss')->get();

        //                  dump($n->toArray());




    public function filter(Request $request){
        dump($request->date);

        $data = ProjectUser::with('user')->where('start','<=',$request->date)
                            ->where('end','>=',$request->date)->get();
        return Inertia::render('Reports/Index',['data'=>$data]);



    }

    public function project_wise_report($project_id=NULL){


       if($project_id=="null" or empty($project_id)){


        $staff = $data = collect([]);
       }
       else if(!empty($project_id)){

            $data = Project::whereId($project_id)->with('staff_project_wise:id,first_name,last_name,photo_path,user_type')->first();
           // dd($data);

            $staff = $data->staff_project_wise->groupBy(['user_type','id']);
       }
       $project = Project::pluck('name','id');

       //dd($staff->toArray());
        return Inertia::render('Reports/ProjectWise',['projects'=>$project, 'data'=>$data , 'staff'=>$staff]);

    }
}
