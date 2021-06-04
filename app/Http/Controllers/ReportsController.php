<?php

namespace App\Http\Controllers;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;
class ReportsController extends Controller
{
    public function index(Request $request)
    {


        if($request->isMethod('post')){
             //dump($request->all());
            $date  = $request->date;
        }else{
            $date  = date('Y-m-d');
        }

        if($date  > date('Y-m-d')){
            return back()->with('error', 'Date must be less than from curremt date.');

        }



        // $n = User::whereHas('pivotss', function (Builder $query)use($date){
        //             $query->whereDate('start','<=',$date)
        //                      ->where( function($q)use($date){
        //                         $q->orWhere('end',null)
        //                         ->whereDate('end','>=',$date);

        //                      });
        //                 })->with('pivotss')->get();

        //                  dump($n->toArray());




        $data = ProjectUser::select(['id','user_id','project_id','start','end'])
                            ->with('user:id,first_name,last_name,photo_path,user_type','project:id,name')
                            ->whereDate('start','<=',$date)
                            //->whereDate('end','>=',$date)
                            ->Where(function($query)use($date){
                                $query->orWhere('end',null)
                                ->orWhereDate('end','>=',$date);
                            })
                            ->get()
                            ->groupBy(['user.user_type','user_id']);
       //dump($data->toArray());



        return Inertia::render('Reports/Index',['data'=>$data->toArray(), 'date'=>$date]);

    //     $n = User::whereHas('pivotss', function (Builder $query)use($date){
    //         $query->where('start','<=',$date);
    //         ->where('end','>=',$date);
    //                  ->where( function($q){
    //                     $q->where('end','>=',date('Y-m-d'));
    //                  });
    //             })->with('pivotss')->get();
    //    User::whereHas('project_rel')->with('project_rel')->whereIn('user_type',['manager','worker'])->get();
    //    $data = ProjectUser::with('user')->where('start','<=',$date)->where('end','>=',$date)
    //    ->get();

    //    dump(date('Y-m-d'),$n->toArray());
    }

    public function filter(Request $request){
        dump($request->date);

        $data = ProjectUser::with('user')->where('start','<=',$request->date)
                            ->where('end','>=',$request->date)->get();
        return Inertia::render('Reports/Index',['data'=>$data]);

       // return response()->json($data);


    }
}
