<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
  
    protected $guarded=[];

    public function user(){

        return $this->belongsTo('App\Models\User');
    }

    protected function getPostImageAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/' . $value);
    }
 
    public function index(){
 
        $posts = Post::all();
 
        foreach($posts as $post){
            $post->post_image = $this->getPostImageAttribute($post->post_image); 
        }
 
        return view('admin.posts.index', ['posts' => $posts]);
    }
   
/*
    public function setPostImageAttribute($value){
        $this->attributes['post_image']=asset($value);
    }

    public function getPostImageAttribute($value){
        return asset($value);
    }

  */  
}
