<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Authors extends Model
{
    protected $fillable =['name'];
    
    public function books(){
    	return $this->hasMany('App\Book');
    }
    public static function boot()
    {
        parent::boot();

        self::deleting(function($author){
            // Mengecek apakah penulis masih punya buku
            if ($author->books->count()> 0) {
                // menyiapkan pesan error
                $html = 'penulis tidak bisa di hapus karena masih memiliki buku :';
                $html .= '<ul>';
                foreach ( $author->books as $book ) {
                    $html .= "<li> $book->title</li>";
                }
                $html .='</ul>';

                Session::flash("flash_notification", [
                    "level"=>"danger",
                    "massage"=>$html 
                    ]);
                // membatalkan proses penghapusan
                return false;
                
            }
        });
    }
}
