<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Post;
use App\User;
use App\Bookmark;
use Illuminate\Support\Facades\Storage;
use Auth;
use Validator;
use Session;
use DB;
use Carbon\Carbon;

class PostController extends Controller
{

   public function index()
   {
    
    if (Auth::guest())
    {
      $posts = Post::latest('id', 'desc')->paginate(6);
       foreach ($posts as $post) 
       {
       $post->judul = str_limit($post->judul, $limit = 30);
       }
       return view('user.index', compact('posts'));
    }else if (Auth::user()->role == 'ADMIN') 
    {
      $posts = Post::latest('id', 'desc')->paginate(6);
      foreach ($posts as $post) 
      {
      $post->judul = str_limit($post->judul, $limit = 30);
      }
      return view('user.index', compact('posts'));
    }else if(Auth::user()->role == 'STUDENT')
    {
      $posts = Post::latest('id', 'desc')->paginate(6);
      foreach ($posts as $post) 
      {
      $post->judul = str_limit($post->judul, $limit = 30);
      }
      return view('user.index', compact('posts'));
    }
   }

   public function create()
   {
      return view('user.create');
   }

   public function store(Request $request){
      $file = $request->file('gambar');

      if($file)
      {
        $rules = array('gambar' =>'required|mimes:jpeg,jpg,png|max:1024');
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
            ->back()
            ->with('error', 'file must be .jpg or .png and max size 1Mb');
        }else{
        $destinationPath = 'images/posts';
        $fileName = rand(0000,9999).$file->getClientOriginalName();
        $upload = $file->move($destinationPath, $fileName);
        }

      if($upload)
      {
     		$post = new Post();
        $post->user_id = auth()->user()->id;
        $post->judul = addslashes($request->get('judul'));//delete addslashes to return it back
        $post->kategori = $request->get('kategori');
        $post->deskripsi = $request->get('deskripsi');
        $post->tanggal = $request->get('tanggal');
        $post->gambar = $fileName;
        $post->save();

        return redirect('/')
        ->with('successMessage', 'Post added');
      }else
      {
        return redirect('/')->with('errors', 'Failed');
      }
   }

   }

  public function edit($id)
   {
      $post = Post::findOrFail($id);
      $user = Auth::user();
      if ($user->role == 'ADMIN' or $post->user_id == Auth::user()->id)
      {
        return view('user.edit', ['post'=>$post]);
      }else
      {
        return redirect('/')->with('editRestrict', 'You only can edit your own posts');
      }
      
   }

  public function update($id, Request $request)
  {
    $file = $request->file('gambar');

    $post = Post::findOrFail($id);
    $post->judul = $request->get('judul');
    $post->kategori = $request->get('kategori');
    $post->deskripsi = $request->get('deskripsi');
    $post->tanggal = $request->get('tanggal');

    if($file)
    {

      $rules = array('gambar' =>'required|mimes:jpeg,jpg,png|max:1024');
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
      return redirect()
      ->back()
      ->with('error', 'file must be .jpg or .png and max size 1Mb');
      }else{
      $destinationPath = 'images/posts';
      $fileName = rand(0000,9999).$file->getClientOriginalName();
      $upload = $file->move($destinationPath, $fileName);
      }
      if($upload)
      {
        $destinationPath= 'images/posts/';
        unlink($destinationPath. $post->gambar);

        $post->gambar = $fileName;
      }else
      {
        return redirect()->back()->with('editError', 'Update failed');
      }
    }
    $post->save();
    Session::flash('edit', 'Post edited');
    return redirect('/');    
  }

  public function destroy($id)
  {
    $destinationPath = 'images/posts/';
    $user = Auth::user();
    $post = Post::findOrFail($id);
    if ($user->role == 'ADMIN' or $post->user_id == Auth::user()->id)
    { 
    if ($post->delete())
    {
      unlink($destinationPath. $post->gambar);
      return redirect('/')->with('delete', 'Post deleted');
    }
    }else
    {
      return redirect('/')->with('errors', 'You must login as admin');
    }
    
  }

  public function category($kategori)
  {
      $posts = Post::latest('id', 'desc')
      ->where('kategori', '=', $kategori)
      ->paginate(6);
      foreach ($posts as $post) 
      {
      $post->judul = str_limit($post->judul, $limit = 30);
      }
      return view('user.index', compact('posts'));
  }

  public function post()
  {
    $posts = Post::latest('id', 'desc')
    ->where('user_id', '=', Auth::user()->id)
    ->paginate(6);
    foreach ($posts as $post) 
    {
    $post->judul = str_limit($post->judul, $limit = 30);
    }
    return view('user.index', compact('posts'));
  }

  public function search()
  {
    $search = '%'.$_GET['search'].'%';
    $posts = Post::where('judul', 'LIKE', '%'.$search.'%')
    ->paginate(6);
    foreach ($posts as $post) {
      $post->judul = str_limit($post->judul, $limit = 30);
    }
    $search = count($posts);
    if ($search > 0) 
    {
      return view('user.index', compact('posts'));
    }else
    {
      return redirect('/')
      ->with('search', 'Competition not found');
    } 
  }

  public function orderByDate(){
    $mytime = Carbon::now();
    $posts = Post::where('tanggal', '>', $mytime)
    ->orderBy('tanggal', 'asc')
    ->paginate(6);
    return view('user.index', compact('posts'));
  }

}