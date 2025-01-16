<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index(User $user) {

        $follows = auth()->user() ? auth()->user()->following->contains($user->id) : false;
        
        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(10),
            function() use ($user) {
                return $user->posts->count();
            }
        );

        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(3),
            function() use ($user) {
                return $user->profile->followers->count();
            }
        );

        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(3),
            function() use ($user) {
                return $user->following->count();
            }
        );

        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user) {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $this->authorize('update', $user->profile);

        $data = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'image' => 'nullable|image',
        ]);

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $data['image'] = $imagePath;
        }

        $user->profile->update($data);

        return redirect("/profile/{$user->id}");
    }

    public function search(Request $request){

        $search = $request->input('search');

        // Attempt to find matching profiles
        $results = Profile::where('title', 'like', "%$search%")->get();

        if ($results->count() === 1) {
            // Redirect to the profile page if exactly one result is found
            return redirect()->route('profile.index', ['user' => $results->first()->user->id]);
        }

        // Return the search view if multiple or no results are found
        return view('profiles.search', ['results' => $results, 'search' => $search]);
    }   

    // public function destroy($id, Profile $profileRepository){
    //     $user = User::findOrFail($id);

    //     $profileRepository->destroy($user->profile_id);

    //     $user->delete();

    //     return redirect('/');
    // }

    public function destroy(User $user) {
        $this->authorize('delete', $user->profile);

        $user->profile->delete();

        $user->delete();

        return redirect('/');
    }

    public function notifications(){

    $notifications = auth()->user()->notifications;

    auth()->user()->unreadNotifications->markAsRead();

    return view('notifications.index', compact('notifications'));
    }
}
