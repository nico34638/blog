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
    private $category_model;
    private $user_model;
    private $post_r;

    public function __construct(Post $post_model, Category $category_model, User $user_model,PostRepository $post_r){
      $this->post_model = $post_model;
      $this->category_model = $category_model;
      $this->user_model = $user_model;
      $this->post_r = $post_r;
    }

    public function index(){
      $this->authorize('view', Post::class);
      $posts = $this->post_r->getPosts()->paginate(10);
      return view('admin.posts.index',[
        'posts' => $posts
      ]);
    }

    public function create(){
      $this->authorize('create', Post::class);
      $post = new Post();
      $categories = Category::pluck('name', 'id');
      $users = User::pluck('name', 'id');
      return view('admin.posts.new', [
          'post' => $post,
          'categories' => $categories,
          'users' => $users
      ]);
    }

    public function store(PostRequest $request){
      $this->post_model->newQuery()->create($this->params($request));
      return redirect()->route('admin.posts.index')->with('success','Votre article a été crée');
    }

    public function edit(Post $post){
      $this->authorize('update', $post);
      $categories = $this->category_model->newQuery()->pluck('name','id');
      $users = $this->user_model->newQuery()->pluck('name', 'id');
      return view('admin.posts.new',[
          'post' => $post,
          'categories' => $categories,
          'users' => $users
      ]);
    }

    public function update(PostRequest $request, Post $post){
      $this->authorize('update', $post);
      $post->update($this->params($request));
      return redirect()->route('admin.posts.index')->with('success','Votre article a été modifié');
    }

    public function destroy(Post $post){
      $this->authorize('delete', $post);
      $post->delete();
      return redirect()->route('admin.posts.index')->with('success','Article supprimer');
    }

    private function params($request){
      $user = Auth::user();
      if($user->can('changeOwner', Post::class)){
        return $request->all();
      }
      else{
        $params = $request->except('user_id');
        $params['user_id'] = $user->id;
        return $params;
      }
    }
}
