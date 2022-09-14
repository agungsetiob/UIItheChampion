<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
		'user_id', 
		'judul',
		'kategori',
		'deskripsi',
		'gambar'
	];

    public function user(){
    return $this->belongsTo(User::class, 'user_id');
    }

    public function bookmarks(){
    return $this->hasMany(Bookmark::class);
    }

}
