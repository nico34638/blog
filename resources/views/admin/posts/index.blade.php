@extends('layouts.app')

@section('content')
  <h1>Gérer ses articles</h1>

    <p>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add a new post</a>
    </p>

  

@endsection
