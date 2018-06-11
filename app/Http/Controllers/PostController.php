<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Comment;
use App\Post;
use App\User;
use App\Repository\PostRepository;

class PostController extends Controller
{
    private $per_page = 5;
    private $post_r;
    private $category_model;
    private $post_model;
    private $user_model;

    public function __construct(PostRepository $post_r,  Category $category_model, Post $post_model, User $user_model){
      $this->post_r = $post_r;
      $this->category_model = $category_model;
      $this->post_model = $post_model;
      $this->user_model = $user_model;
    }

    public function index()
    {
      $posts = $this->post_r->getPosts()->paginate($this->per_page);
      $categories =  $this->category_model->newQuery()->get();
      return view('posts/index', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function category($slug)
    {
        $categories =  $this->category_model->newQuery()->get();
        $category = $this->category_model->newQuery()->where('slug', '=', $slug)->first();
        $posts = $this->post_model->newQuery()->with('category', 'user')->where('category_id', $category->id)->paginate($this->per_page);
        return view('posts.index',[
          'categories' => $categories,
          'category' => $category,
          'posts' => $posts
        ]);
    }

    public function user($user_id){
        $categories =  $this->category_model->newQuery()->get();
        $user = $this->user_model->find($user_id);
        $posts = $this->post_model->with('category', 'user')->where('user_id', $user->id)->paginate($this->per_page);
        return view('posts.index', compact('posts', 'user'),[
          'categories' => $categories,
          'user' => $user,
          'posts' => $posts
        ]);
    }

    public function show($slug){
      $post = $this->post_model->where('slug',$slug)->first();
      return view('posts.show',[
        'post' => $post
      ]);
    }




}
