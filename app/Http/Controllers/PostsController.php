<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostsController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)
                    ->with(['user.profile', 'likes'])
                    ->latest()
                    ->get();

        $follows = auth()->user()->following;

        return view('posts.index', compact('posts', 'follows'));
    }


    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){

        $data = request()->validate([
            'caption' => 'nullable|string',
            'image' => ['nullable', 'image'],
        ]);

        $imagePath = $data['image'] ? $request->file('image')->store('uploads', 'public') : null;
    
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);
    
        return redirect('/profile/' . auth()->user()->id);
    }
    
    public function destroy(Post $post){
        if(auth()->user()->id !== $post->user_id){
            abort(403, 'Unauthorized action.');
        }
    
        $post->delete();
    
        return redirect('/profile/' . auth()->user()->id);
    }

    public function like(Post $post){
        $user = auth()->user();

        $like = Like::where('user_id', $user->id)->where('post_id', $post->id)->first();

        if($like){
            $like->delete();
            return response()->json(['liked' => false, 'likeCount' => $post->likes()->count()]);
        }

        Like::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        return response()->json(['liked' => true, 'likeCount' => $post->likes()->count()]);
    }
}
