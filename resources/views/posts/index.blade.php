@extends("layouts.app")




@section('content')
<style>
  .article{

  }
</style>
  <div class="container">
    <div class="row">
      <div class="col-md-8 article">
        @foreach($posts as $post)
            <h2><a href="{{ route('posts.show', ['slug' => $post->slug]) }}">{{ $post->name }}</a></h2>
            <p>
                <small>
                    Category : <a href="{{ route('posts.category', ['slug' => $post->category->slug]) }}">{{ $post->category->name }}</a>
                    by <a href="{{ route('posts.user', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a>
                    on {{ $post->created_at->format('M dS Y') }}
                </small>
            </p>
            <p>
              {{ $post->getExtrait()}}
            <p class="text-right">
                <a href="{{ route('posts.show', ['slug' => $post->slug]) }}" class="btn btn-primary">Read more...</a>
            </p>
        @endforeach

        <div class="navigation">
          {{ $posts->links('vendor.pagination.bootstrap-4') }}
        </div>
      </div>

      <div class="col-md-3">
        <div class="list-group">
          @foreach ($categories as $category)
            <a class="list-group-item d-flex justify-content-between align-items-center" href="{{ route('posts.category', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
          @endforeach
        </div>
      </div>

    </div>
  </div>


  <div class="container">

  </div>

@endsection
