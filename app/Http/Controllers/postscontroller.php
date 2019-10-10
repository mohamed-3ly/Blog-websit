<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use Validator;
use App\Post;
class postscontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    //index page
    public function index(){
        //dd(post::all());
        $posts = post::orderBy('id','desc')->paginate(6) ;
        $count = post::count() ;
        return view('posts.index' , compact('posts','count') );
    }

    //show page
    public function show($id){
        $post = Post::find($id);
        return view('posts.show' , compact('post'));
    }

    //creat page
    public function create(){
        return view('posts.create');
    }

    //store post
    public function store(Request $request){

        
        $request->validate([
            'title' =>  'required|max:200',
            'body' => 'required|max:500',
            'coverImage' => 'image|mimes:jpeg,bmp,png|max:1999'
        ]);

        if ($request->hasFile('coverImage')) {
            $file = $request->file('coverImage') ;
            $ext = $file->getClientOriginalExtension() ;
            $filename = 'cover_image' . '_' . time() . '.' . $ext ;
            $file->storeAs('public/coverImages', $filename);
          
        } else {
            $filename = 'noimage.png';
        }

        $post = new Post() ;
        $post->title =  $request->title ;
        $post->body =  $request->body ;
        $post->image = $filename;
        $post->user_id =auth() ->user()->id;

        $post->save();
        return redirect('/posts')->with('status', 'Post was created !');
    }

    //edit post
    public function edit($id){
        $post = Post::find($id);
        
        if(auth()->user()->id !== $post->user_id){
            return redirect ('/posts')->with('error' , 'You are not authorized');
        }
        return view('posts.edit' , compact('post'));
    }

    //update post form
    public function update(Request $request , $id){
        $post = Post::find($id);
        $filename = $post->image;
        $request->validate([
            'title' =>  'required|max:200',
            'body' => 'required|max:500',
            'coverImage' => 'image|mimes:jpeg,bmp,png|max:1999'
        ]);
        if ($request->hasFile('coverImage')) {
            //first delete the old image but don't delete noimage.png , it's place hplder
            //dd($filename);
            if( $filename !== "noimage.png"){
            Storage::disk('public')->delete('coverImages/' . $filename);
            }
            //then generate the name of the new image and save it
            $file = $request->file('coverImage') ;
            $ext = $file->getClientOriginalExtension() ;
            $filename = 'cover_image' . '_' . time() . '.' . $ext ;
            $file->storeAs('public/coverImages', $filename);
          
        } 
        // ther is no else because it update method not store , and you should leave the old image as it is 
        
        $post->title =  $request->title ;
        $post->body =  $request->body ;
        $post->image = $filename;
        $post->save();

        return redirect('/posts')->with('status', 'Post was updated !');
    }

    //destroy post
    public function destroy($id){
        $post = Post::find($id);
        $filename = $post->image;
        
        if( $filename !== "noimage.png"){
            
            Storage::disk('public')->delete('coverImages/' . $filename);
        }
        $post->delete();

        return redirect('/posts')->with('status', 'Post was deleted !');
    }


}
