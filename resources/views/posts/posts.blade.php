@extends('layouts.app')

@section('content')
    <h1 style="margin-top: 20px; text-align:center">Latest Posts</h1>
    <hr>
    @if(count($posts) > 0)
        <div class="row justify-content-center">
            @foreach($posts as $post)
                <div class="card col-md-3" style="width: 16rem; margin:10px">
                    <img class="card-img-top" src="/storage/cover_images/{{$post->cover_image}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <p class="card-text">{{$post->created_at}}</p>
                    </div>
                    <div class="card-footer">
                        <a href="/posts/{{$post->id}}" class="btn btn-primary" style="width:100%">See Post</a>
                    </div>
                </div>
            @endforeach
        </div>
        {{$posts->links()}}
    @else
        <h2>There is No Posts Yet</h2>
    @endif
@endsection