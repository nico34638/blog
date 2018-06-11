<?php

namespace App\Repository;

use App\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PostRepository{
  private $post;

  public function __construct(Post $post){
    $this->post = $post;
  }

  public function getPosts(){
    $posts = $this->post->newQuery();
    return $posts;
  }

  public function getPostsWithSlug($slug){
    $posts = $this->post->newQuery()->select('name','slug')->where('slug', '=', $slug)->get();
    return $posts;
  }
}

?>
