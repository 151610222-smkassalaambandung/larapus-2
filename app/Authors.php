<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facade\Session;

class Authors extends Model
{
    protected $fillable =['name'];
    public function books()
    public static function boot()
    {
    	parent::boot();

    	self::deleting(function($author){
    		// Mengecek apakah penulis masih punya buku
    		if ($author->books->count()> 0) {
    			
    		}
    	})
    	return $this->hasMany('App\Book');
    }
}
