<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserFollowed;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(User $user)
{
    // Toggle the follow status
    $result = auth()->user()->following()->toggle($user->profile);

    // Check if the user was followed (attached) or unfollowed (detached)
    if (in_array($user->id, $result['attached'])) {
        // If followed, send a notification
        $user->notify(new UserFollowed(auth()->user()));
    }

    return response()->json(['success' => true]);
}

}
