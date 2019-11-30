<?php

namespace App\Http\Controllers;

use App\Follow;
use App\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(User $user)
    {
        return auth()->user()->following()->toggle($user->profile);
    }

    public function show(Follow $follow)
    {
        //
    }

    public function edit(Follow $follow)
    {
        //
    }

    public function update(Request $request, Follow $follow)
    {
        //
    }

    public function destroy(Follow $follow)
    {
        //
    }
}
