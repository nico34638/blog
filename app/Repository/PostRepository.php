<?php

namespace App\Repository;

use App\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PostRepository{
  private $post_model;

  public function __construct(Post $post_model){
    $this->post_model = $post_model;
  }

  public function getPosts(){
    $posts = $this->post_model->newQuery();
    return $posts;
  }

  public function getPostsWithSlug($slug){
    $posts = $this->post_model->newQuery()->select('name','slug')->where('slug', '=', $slug)->get();
    return $posts;
  }

  public function CreatePost($name, $slug, $content, $category_id, $user_id){
    $post = $this->post_model->newQuery()->create([
      'name' => $name,
      'slug' => $slug,
      'content' => $content,
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      'category_id' => $category_id,
      'user_id' => $user_id
    ]);
    return $post;
  }
}

?>
