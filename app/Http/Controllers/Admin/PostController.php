<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Repository\PostRepository;

class PostController extends \App\Http\Controllers\Controller {

    private $post_model;
    private $post_r;

    public function __construct(Post $post_model, PostRepository $post_r){
      $this->post_model = $post_model;
      $this->post_r = $post_r;
    }

    public function index(){
      $posts = $this->post_r->getPosts()->paginate(10);
      return view('admin.posts.index',[
        'posts' => $posts
      ]);
    }

    public function create(){

    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){
      
    }

}
