<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;

class PostController extends Controller
{
    //------------this is the index function to view all posts 
    public function index(){

           $posts=Post::paginate(3);
           
           return view('posts.index',[ 'posts'=>$posts ,]);
    }
     
    //-------------this is for the create post button 
    public function create(){
        $users=User::all();

        return view('posts.create',['users'=>$users]);
    }

    //---------------this to update post details and store it again
    public function update(Request $request,Post $post){
        // $request=request();
        $exist=Post::find($post);
        if($exist){
            $post->update($request->all());
            return redirect()->route('posts.index');
        }

    }
        
    //--------------this function to delete post from database
    public function destroy(Request $request,Post $post){
        
        $post->delete($request->id);
        return redirect()->route('posts.index');
      
    }

   //-----------------this to store element to database
    public function store(){

           $request=request();
           Post::create(['title'=>$request->title,
                        'description'=>$request->description,
                         'user_id'=>$request->user_id]);
                    return redirect()->route('posts.index');
    }

  //------------------is function to display details of certain post
    public function show(){

           $request=request();
           $postId=$request->post;
           $post=Post::find($postId);
           $user=User::find($post->user_id);
           return view('posts.show',['post'=>$post,'owner'=>$user]);
    }

    //----------------this to view wanted to edit post 
    public function edit($id){
       
        $post=Post::find($id);
        $user=User::find($post->user_id);
        $users=User::all();
        return view('posts.edit',['post'=>$post,'user'=>$user,'users'=>$users]);
    }
}
