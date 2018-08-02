@extends('layouts.app')

@section('content')
<div style="background-color:white; padding:15px; border-radius:10px">
    <h1 style="margin-top: 20px;">{{$post->title}}</h1>
    <span>Written on: {{$post->created_at}}</span>
    <hr class="my-4">
    <img src="/storage/cover_images/{{$post->cover_image}}" style="width:100%;">
    <p style="color:black; font-size:1.5rem">{!!$post->body!!}</p>
    <hr class="my-4">
    <a href="/posts" class="btn btn-primary">Back To Posts</a>
    @auth
        @if(Auth::user()->id == $post->user_id)
        <a class="btn btn-secondary" href="/posts/{{$post->id}}/edit">Edit Post</a>
        <form action="{{action('PostsController@destroy', $post->id)}}" method="POST" class="float-right">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        @endif
    @endauth
</div>
@endsection