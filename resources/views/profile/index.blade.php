@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 pl-5">
        <img src="{{$user->profile->profileImage()}}" style="height: 100px; width: 100px;"  class="rounded-circle">
        </div>
        <div class="col-9 pr-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="h4 pr-4">{{ $user->username }}</div>

                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                </div>

            @can('update',$user->profile)
                    <a href="{{route('posts.create')}}">Add new post</a>
                @endcan
            </div>
            @can('update',$user->profile)
            <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">
                <div class="pr-4"><strong>{{$postCount}}</strong> posts</div>
                <div class="pr-4"><strong>{{$followersCount}}</strong> followers</div>
                <div class="pr-4"><strong>{{$followingCount}}</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{$user->profile->title }}</div>
            <div>{{$user->profile->description }}</div>
            <div><a href="#">{{$user->profile->url}}</a></div>
        </div>
    </div>
    <div class="row p-5" >
        @foreach($user->posts as $post)
            <div class="col-4 pt-3">
                <a href="/posts/{{$post->id}}">
                    <img src="/storage/{{$post->image}}" class="w-100">
                </a>
            </div>
        @endforeach





    </div>
</div>
@endsection
