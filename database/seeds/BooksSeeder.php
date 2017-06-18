<?php

use Illuminate\Database\Seeder;
use App\Authors;
use App\Book;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Sample penulis
        $author1=Authors::create(['name'=>'Mohammad fauzil']);
        $author2=Authors::create(['name'=>'salim a fillah']);
        $author3=Authors::create(['name'=>'aam amiruddin']);

        // Sample buku
        $book1=Book::create(['title'=>'kupinang kau dengan hamdallah','amount'=>3,'author_id'=>$author1->id]);
        $book2=Book::create(['title'=>'jalan cinta para pejuang','amount'=>2,'author_id'=>$author2->id]);
        $book3=Book::create(['title'=>'membingkai surga dalam rumah tagga','amount'=>4,'author_id'=>$author3->id]);
        $book4=Book::create(['title'=>'cinta & seks rumah tangga muslim','amount'=>3,'author_id'=>$author3->id]);

    }
}
