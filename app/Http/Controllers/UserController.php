<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Models\Role;

class UserController extends Controller
{
    //
    public function index(){
        $users=User::all();
        return view('admin.users.index', ['users'=>$users]);
    }

    

    public function show(User $user){

        return view('admin.users.profile', [
            
            'user'=>$user,
        'roles'=>Role::all()
    ]);
    }


    public function update(User $user){
        $inputs=request()->validate([
            'username'=>['required', 'max:255', 'alpha_dash'],
            'name'=>['required','string', 'max:255'],
            'email'=>['required', 'email', 'max:255'],
            'avatar'=>['file']

        ]);

        if(request('avatar')){
            //dd(request('avatar'));
            $inputs['avatar']=request('avatar')->store('images');
        }
        $user->update($inputs);
        return back();

    }

        public function attach(User $user){
           $user->roles()->attach(request('role'));
           return back();
        }

        public function detach(User $user){
            $user->roles()->detach(request('role'));
            return back();
         }

    public function destroy(User $user){

        //if(auth()->user()->id !== $post->user_id) sprijeciti nekog da brise moj post

    //    $this->authorize('delete', $user);
        $user->delete();

        Session::flash('message', 'korisnik je obrisan');
        return back();
    }


    public function create(){

        return view('admin.users.create');
    }

    public function store(Request $request){
        return $request->all();

    }
       




}
