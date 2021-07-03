<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //

    public function index(){

     // $posts=Post::all(); //npr. svi mogu brisati postove
        $posts=auth()->user()->posts()->paginate(); //vidim svoje objave, ali ako gore ukucam/21/ mogu i tuđu prepraviti
        
        return view('admin.posts.index', ['posts'=>$posts]);
    }

  

    public function show(Post $post){

        return view('blog-post',  ['post'=>$post]);
    }

    public function create(){

        return view('admin.posts.create');
    }

    public function store(){

        $this->authorize('create', Post::class);
       //dd(request()->all());
        //auth()->user();
        $inputs=request()->validate([

            'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            'body'=>'required'
        ]);
        if(request('post_image')){
            $inputs['post_image']=request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);

        session()->flash('post-created-message', 'Post je kreiran');
        return redirect()->route('post.index');
    }


    public function edit(Post $post){
        
        $this->authorize('view', $post);

        return view('admin.posts.edit', ['post'=>$post]);
    }

    public function update(Post $post){
        $inputs=request()->validate([

            'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            'body'=>'required'
        ]);

        if(request('post_image')){
            $inputs['post_image']=request('post_image')->store('images');
        $post->post_image=$inputs['post_image'];
        }

        $post->title=$inputs['title'];
        $post->body=$inputs['body'];

        //auth()->user()->posts()->save($post); PROMIJENI VLASNIKA
        
        $this->authorize('update', $post);
        $post->save();
        session()->flash('post-update-message', 'post je azuriran');

        return redirect()->route('post.index');
    }


    public function destroy(Post $post){

        //if(auth()->user()->id !== $post->user_id) sprijeciti nekog da brise moj post

        $this->authorize('delete', $post);
        $post->delete();

        Session::flash('message', 'Post je obrisan');
        return back();
    }


 

}
