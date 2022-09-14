<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Session;

use Validator;
use App\User;
use App\Post;
use Auth;
use DB;

class ProfileController extends Controller
{
    public function index($username){
      $id = Auth::user()->id;
    	$post = Post::where('user_id', '=', $id)
    	->count();

        if ($post == 0){
            $level = '<i class="fa fa-btn fa-star">';
        }elseif ($post < 6) {
            $level = '<i class="fa fa-btn fa-star star">';
        }elseif ($post < 11) {
            $level = '<i class="fa fa-btn fa-star star">
            <i class="fa fa-btn fa-star star">';
        }elseif ($post < 16) {
            $level = '<i class="fa fa-btn fa-star star">
            <i class="fa fa-btn fa-star star">
            <i class="fa fa-btn fa-star star">';
        }elseif ($post < 21) {
            $level = '<i class="fa fa-btn fa-star star">
            <i class="fa fa-btn fa-star star">
            <i class="fa fa-btn fa-star star">
            <i class="fa fa-btn fa-star star">';
        }elseif ($post >=21) {
            $level = '<i class="fa fa-btn fa-star star">
            <i class="fa fa-btn fa-star star">
            <i class="fa fa-btn fa-star star">
            <i class="fa fa-btn fa-star star">
            <i class="fa fa-btn fa-star star">';
        }

    	return view('user.profile', compact('post', 'level'));
    }

    public function rank(){
    	$users = User::leftJoin('posts', 'posts.user_id', '=', 'users.id')
      ->groupBy('users.id')
      ->select(DB::raw('users.*, count(posts.user_id) as posts_count'))
      ->orderBy('posts_count', 'desc')
      ->orderBy('name', 'asc')
      //->whererole('student')
      ->paginate(5);

      if(Input::has('page')){
        $page = Input::get('page');    
      }else{
        $page = 1;
      } 
      $no = 5*$page-4;

    	return view ('user.rank', compact('users', 'no'));
    }

    public function addAccount(){
      if (Auth::user()->role == 'ADMIN') {
        $users = User::latest('id', 'asc')
        ->paginate(10);
        if (Input::has('page')){
          $page = Input::get('page');    
        }else{
          $page = 1;
        } 
        $no = 10*$page-9;
        return view('user.account', compact('users', 'no'));
      }else{
        return redirect()->back();
      }
      
    }
 
    public function uploadFile(){
     try
     {
       Excel::load(\Input::file('file'), function($reader) {
         foreach ($reader->toObject() as $row)
         {
           $users = new User;
           $users->name = $row->name;
           $users->username = $row->username;
           $users->email = $row->email;
           $users->password = $row->password;
           $users->role = $row->role;
           $users->save();
         }
       });
          Session::flash('message', 'user uploaded successfully');
          return redirect('add-students');
      }
      catch (\Exception $e)
      {
          Session::flash('error', $e->getMessage());
          return redirect('add-students');
      }
    }

    public function updateProfile($username, Request $request)
    {
      $file = $request->file('avatar');

      if($file)
      {
        
        $rules = array('avatar' =>'required|mimes:jpeg,jpg,png|max:1024');
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
            ->back()
            ->with('error', 'update failed, file must be .jpg or .png and max size 1Mb');
        }else{
        $destinationPath = 'images/avatar';
        $fileName = rand(0000,9999).$file->getClientOriginalName();
        $upload = $file->move($destinationPath, $fileName);

        if($upload)
        {
          Auth::user()->avatar = $fileName;
          Auth::user()->save();
          return redirect()->back()->with('message', 'Avatar updated');
        }else
        {
          return redirect()
          ->back()
          ->with('error', 'Update failed, please try again');
        }
      }
      }   
    }

}
