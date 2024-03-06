<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $posts = Post::select('posts.id', 'posts.title', 'posts.description', 'posts.user_id')
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('posts.title', 'like', '%' . $search . '%')
                          ->orWhere('posts.description', 'like', '%' . $search . '%')
                          ->orWhere('users.name', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('posts.id', 'desc')
            ->paginate(10);
    
        $posts->appends(['search' => $search]);
    
        return view('posts.index', ['posts' => $posts, 'search' => $search]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $user_id = auth()->user()->id;

        $post = new Post();
        $post->user_id = $user_id;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect()->back()->with('success','Post created successfully.');
    }

    public function show($id)
    {
    	$post = Post::find($id);
        if(!$post){
            abort(404);
        }
        return view('posts.show', compact('post'));
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if($post){
            $comments = Comment::where('post_id', $id)->get();
            if($comments){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }
            $post->delete();
        }
        Session::flash('success', 'Post deleted successfully.'); 

        return response()->json(['success' => true, 'message' => 'Post deleted successfully.']);
        
    }

    public function edit($id)
    {
        $post = Post::find($id);

        return response()->json([
           'status' => 200,
           'post' => $post,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $post_id = $request->post_id;
        $post = Post::find($post_id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect()->back()->with('success', 'Post updated successfully.');
    }
}
