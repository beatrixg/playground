<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'avatar',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value){

        $this->attributes['password']=bcrypt($value);
    }


    public function posts(){

        return $this->hasMany('App\Models\Post');
}


public function permissions(){

    return $this->belongsToMany(Permission::class);
}

public function roles(){

    return $this->belongsToMany(Role::class);
}

public function userHasRole($role_name){
    //if(is_array())
    foreach($this->roles as $role){
        if(Str::lower($role_name)==Str::lower($role->name))
            return true;
    }
    return false;
}



protected function getAvatarAttribute($value) {
    if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
        return $value;
    }
    return asset('storage/' . $value);
}

public function index(){

    $users = User::all();

    foreach($users as $user){
        $user->avatar = $this->getAvatarAttribute($user->avatar); 
    }

    return view('user.profile.show', ['users' => $users]);
}






}
