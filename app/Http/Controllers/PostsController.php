<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('posts.posts')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required|min:10',
            'cover_image' => 'image|nullable|max:1999',
        ]);
        //handle file upload
        if($request->hasFile('cover_image')) {
            //get file name with ext
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get file name without ext
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //file name to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        } else {
            $filenameToStore = 'noimage.jpg';
        }

        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filenameToStore;
        $post->save();
        //Post::create($request->all());

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.post')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Accesss');
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|min:10',
            'cover_image' => 'image|nullable|max:1999',
        ]);
        //handle file upload
        if($request->hasFile('cover_image')) {
            if($request->input('old_image')!='noimage.jpg'){    
                Storage::delete('public/cover_images/'.$request->old_image);
            }
            //get file name with ext
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get file name without ext
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //file name to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        }
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        if($request->hasFile('cover_image')) {
            $post->cover_image = $filenameToStore;
        }
        $post->save();
        //Post::where('id', $id)->update($request->except('_method', '_token'));

        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Accesss');
        }

        if($post->cover_image !== 'noimage.jpg') {
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();

        return redirect('/posts')->with('success', 'Post Deleted');
    }
}
