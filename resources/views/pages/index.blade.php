@extends('layouts.app')

@section('content')
    <div class="jumbotron" style="margin-top: 20px">
        <h1 class="display-4">Welcome To MyBlog</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
        <a class="btn btn-success btn-lg" href="/regester" role="button">Regester</a>
    </div>
@endsection