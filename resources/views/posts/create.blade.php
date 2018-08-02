@extends('layouts.app')

@section('content')
    <h1 style="margin-top:20px">Create Post</h1>
    <form action="{{action('PostsController@store')}}" method="POST" enctype="multipart/form-data" style="margin-top:20px">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Post title">
        </div>
        <div class="form-group">
            <label for="article-ckeditor">Body</label>
            <textarea id="ckeditor" name="body" class="form-control" placeholder="Post body" style="height:300px" ></textarea>
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