@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary">Create New Post</a>
                    <hr>
                    <h3>Your Blog Posts</h3>
                    @if(count($posts) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>
                                    <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                                </td>
                                <td>
                                    <a href="/posts/{{$post->id}}/edit" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                                <td>
                                    <form action="{{action('PostsController@destroy', $post->id)}}" method="POST" class="float-right">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <h3>You Have No Posts Yet</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
