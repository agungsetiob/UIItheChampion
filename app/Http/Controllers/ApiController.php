<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Post;
use App\User;
use DB;
class ApiController extends Controller
{
    public function post()
    {
		$data = Post::join('users', 'users.id', '=', 'posts.user_id')
		->select(
		'users.username',
		'posts.judul',
		'posts.gambar',
		'posts.deskripsi',
		'posts.tanggal',
		'posts.kategori',
		'posts.created_at'
		)
		->orderBy('posts.id', 'desc')
		->get();
		return response()->json($data,200);
		
	}

	public function category($kategori)
	{
		$data = Post::join('users', 'users.id', '=', 'posts.user_id')
		->select(
		'users.username',
		'posts.judul',
		'posts.gambar',
		'posts.deskripsi',
		'posts.tanggal as deadline',
		'posts.kategori',
		'posts.created_at'
		)
		->wherekategori($kategori)
		->orderBy('posts.id', 'desc')
		->get();
      	return response()->json($data,200);
	}


}
