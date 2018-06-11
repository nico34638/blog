@extends("sidebar")

@section('main')
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <p><a href="{{ route('posts.index') }}">Retour a la liste des articles</a></p>
        <h1>{{ $post->name }}</h1>
        <p>
          <small>
              Category : <a href="">{{ $post->category->name }}</a>
              by <a href="">{{ $post->user->name }}</a>
              on {{ $post->created_at->format('M dS Y') }}
          </small>
        </p>
        <p>
          {{ $post->content }}
        </p>
        <p>&nbsp;</p><!-- I know.... -->

      </div>
    </div>
  </div>
@endsection
