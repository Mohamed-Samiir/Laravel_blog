@extends('layouts.app')

@section('content')
    <h1 style="margin-top:20px">Create Post</h1>
    <form action="{{action('PostsController@update', $post->id)}}" method="POST" enctype="multipart/form-data" style="margin-top:20px">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <input type="hidden" name="old_image" value="{{$post->cover_image}}">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Post title" value="{{$post->title}}">
        </div>
        <div class="form-group">
            <label for="article-ckeditor">Body</label>
            <textarea id="ckeditor" name="body" class="form-control" placeholder="Post body" style="height:300px" >{{$post->body}}</textarea>
        </div>
        <div class="form-group">
            <input type="file" class="form-control-file" name="cover_image"  aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script>
        CKEDITOR.replace( 'ckeditor' );
    </script>
@endsection