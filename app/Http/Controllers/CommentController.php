<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentsNotification;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:500',
        ]);

        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        // $post = Post::findOrFail($request->post_id);
        // $postOwner = $post->user;
        // $postTitle = $post->caption;

        // if($postOwner->id !== auth()->id()) {
        //     $postOwner->notify(new CommentsNotification(auth()->user(), $post, $postTitle, $request->content));
        // }

        return back()->with('success', 'Comment added successfully');
    }
}
