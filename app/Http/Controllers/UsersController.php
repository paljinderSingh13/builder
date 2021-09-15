<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProjectUser;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UsersController extends Controller
{


public function staff($type){

    $auth_type = Auth::user()->user_type;
    $staff = User::select(['id', 'first_name', 'last_name', 'email', 'photo_path', 'address', 'mobile', 'employee_id', 'expertise', 'emergency_contact', 'user_type', 'date_of_joining'])
            ->whereUserType($type)
            ->orderBy('id','desc')
            ->with('staff_availablity:id')
            ->get();

   // dd($staff->toArray());
            // ->transform(fn ($user)=>['id' => $user->id,
            //             'name' => $user->name,
            //             'email' => $user->email,
            //             'mobile' => $user->mobile,
            //             'owner' => $user->owner,
            //             'photo' => $user->photo_path ? URL::route('image', ['path' => $user->photo_path, 'w' => 80, 'h' => 80, 'fit' => 'crop']) : null,
            //             'deleted_at' => $user->deleted_at]
            //         );
    return Inertia::render('Staff/Index',['data'=>$staff,'user_type'=>$type,'auth_type'=>$auth_type]);

}

public function status(){

    $user = User::select(['id', 'first_name', 'last_name', 'email', 'photo_path', 'mobile',  'user_type'])
            ->whereIn('user_type',['manager','worker'])
            ->withCount('staff_availablity')
            ->get()
            ->groupBy('user_type');
           //dd($user->toArray());

    return Inertia::render('Staff/Status',['data'=>$user]);

}

    public function index()
    {


       $users =  User::orderByName()
                ->filter(Request::only('search', 'role', 'trashed'))
                ->get();
                // ->transform(fn ($user) => [
                //     'id' => $user->id,
                //     'name' => $user->name,
                //     'email' => $user->email,
                //     'mobile' => $user->mobile,
                //     'owner' => $user->owner,
                //     'photo' => $user->photo_path ? URL::route('image', ['path' => $user->photo_path, 'w' => 80, 'h' => 80, 'fit' => 'crop']) : null,
                //     'deleted_at' => $user->deleted_at,
                // ]);

        return Inertia::render('Users/Index', [
            'filters' => Request::all('search', 'role', 'trashed'),
            'users' => $users
        ]);

        // Auth::user()->account->users()
        //         ->orderByName()
        //         ->filter(Request::only('search', 'role', 'trashed'))
        //         ->get()
        //         ->transform(fn ($user) => [
        //             'id' => $user->id,
        //             'name' => $user->name,
        //             'email' => $user->email,
        //             'mobile' => $user->mobile,
        //             'owner' => $user->owner,
        //             'photo' => $user->photo_path ? URL::route('image', ['path' => $user->photo_path, 'w' => 40, 'h' => 40, 'fit' => 'crop']) : null,
        //             'deleted_at' => $user->deleted_at,
        //         ]),
    }


    public function staff_create($type)
    {
        return Inertia::render('Staff/Create',['type'=>$type]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store()
    {

        // dd(Request::all());
        Request::validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')],
            'mobile' => ['required','digits_between:10,12','integer'],
            'emergency_contact' => ['nullable','digits_between:10,12','integer'],
            'password' => ['required','min:8'],
            // 'owner' => ['required', 'boolean'],
            'photo' => ['nullable', 'image'],
        ]);


        Auth::user()->account->users()->create([
            'first_name' => Request::get('first_name'),
            'last_name' => Request::get('last_name'),
            'email' => Request::get('email'),
            'mobile'=>Request::get('mobile'),
            'password' => Request::get('password'),
            // 'owner' => Request::get('owner'),
            'photo_path' => Request::file('photo') ? Request::file('photo')->store('users') : null,
            "address" => Request::get('address'),
            "employee_id" => Request::get('employee_id'),
            "expertise" => Request::get('expertise'),
            "emergency_contact" => Request::get('expertise'),
            "user_type" => Request::get('user_type'),
            "date_of_joining" => Request::get('date_of_joining')
        ]);

        return Redirect::route('staff',Request::get('user_type'))->with('success', Request::get('user_type').' Added Successfully.');
    }

    public function edit(User $user)
    {

        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'mobile'=> $user->mobile,
                'email' => $user->email,
                'owner' => $user->owner,
                'photo' => $user->photo_path ? URL::route('image', ['path' => $user->photo_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null,
                "address" => $user->address,
                "employee_id" => $user->employee_id,
                "expertise" => $user->expertise,
                "emergency_contact" => $user->expertise,
                "user_type" => $user->user_type,
                "date_of_joining" => $user->date_of_joining,
                'deleted_at' => $user->deleted_at,
            ],
        ]);
    }

    public function update(User $user)
    {
        if (App::environment('demo') && $user->isDemoUser()) {
            return Redirect::back()->with('error', 'Updating the demo user is not allowed.');
        }

        Request::validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable'],
            // 'owner' => ['required', 'boolean'],
            'photo' => ['nullable', 'image'],
            'mobile' => ['required','digits_between:10,12','integer'],
            'emergency_contact' => ['nullable','digits_between:10,12','integer'],
        ]);

        $user->update(Request::only('first_name', 'last_name', 'email', 'owner','mobile' , 'address', 'employee_id' ,'expertise', 'emergency_contact' , 'date_of_joining'));

        if (Request::file('photo')) {
            $user->update(['photo_path' => Request::file('photo')->store('users')]);
        }

        if (Request::get('password')) {
            $user->update(['password' => Request::get('password')]);
        }

        return Redirect::back()->with('success', $user->user_type.' Updated Successfully.');
    }

    public function destroy(User $user)
    {
        if (App::environment('demo') && $user->isDemoUser()) {
            return Redirect::back()->with('error', 'Deleting the demo user is not allowed.');
        }
        $user_type = $user->user_type;
        $user->delete();

        return Redirect::route('staff',$user_type)->with('success', $user_type.' Deleted Successfully.');


        //return Redirect::back()->with('success', 'User deleted.');
    }

    public function restore(User $user)
    {
        $user->restore();

        return Redirect::back()->with('success', 'User restored.');
    }

    public function detail($type , User $user){

       return Inertia::render('Staff/Detail',['user_type'=>$type, 'user'=>$user->toArray()]);

    }
}
