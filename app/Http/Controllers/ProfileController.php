<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\User;

class ProfileController extends Controller
{

    public  function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $user=User::findOrFail($id);
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            });
        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
            });
        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->following->count();
            });
        return view('profile.index', compact('user', 'follows','postCount','followersCount', 'followingCount'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function edit(User $user)
    {
        $this->authorize('update',$user->profile);
        return view('profile.edit',compact('user'));

    }


    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        $data=request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url'=>'url',
            'image'=>'',
        ]);
//        dd($data);
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        return redirect("/profile/{$user->id}");
    }


    public function destroy($id)
    {
        //
    }
}
