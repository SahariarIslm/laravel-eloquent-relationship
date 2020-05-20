<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Auth;
class PostController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        //check validation
        $this->validate($request,[
            'title'=>'required',
            'description' => 'required'
            
        ]);

    	$post = new Post();
    	$post->title = $request->title;
    	$post->description = $request->description;
    	$post->category_id = $request->category_id;
    	$post->user_id = Auth::id();

    	$post->save();
        $post->tags()->sync($request->tags,false);
    	return redirect('/home');
    }
    public function category($id){
        $category = category::find($id);
        return view('category',compact('category'));
    }
}
