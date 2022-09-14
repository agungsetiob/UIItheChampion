<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post as Post;
use App\User as User;
use App\Bookmark as Bookmark;
use Illuminate\Support\Facades\Storage;
use Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = User::findOrFail(Auth::user()->id)->bookmarks()
        ->join('users', 'users.id', '=', 'bookmarks.user_id')
        ->join('posts', 'posts.id', '=', 'bookmarks.post_id')
        ->select(
        'users.username',
        'posts.judul',
        'posts.gambar',
        'posts.deskripsi',
        'posts.tanggal',
        'posts.kategori',
        'posts.created_at',
        'posts.user_id',
        'bookmarks.id',
        'bookmarks.post_id'
        )
        ->orderBy('id', 'desc')
        ->paginate(3);
        return view('user.bookmark', compact('bookmarks'));
    }

    public function store( Request $request)
    {
        $bookmark = new Bookmark();
        $bookmark->user_id = auth()->user()->id;
        $bookmark->post_id = $request->get('post_id');
        $bookmark->save();
        return redirect('user/bookmarks')
        ->with('successMessage', 'Bookmark added');
    }

    public function destroy($id)
    {
        $bookmark = Bookmark::findOrFail($id);
        $bookmark->delete();
        return redirect('user/bookmarks')
        ->with('successMessage', 'Bookmark deleted');
    }

    public function download(){
        $file = public_path().'/UIItheChampion.apk';
        return response()->download($file);   
    }

}
