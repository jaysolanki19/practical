<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $user_id = auth()->user()->id;

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->parent_id = $request->parent_id;
        $comment->user_id = $user_id;
        $comment->save();

        return back()->with('success', 'Comment added successfully');
    }

}
