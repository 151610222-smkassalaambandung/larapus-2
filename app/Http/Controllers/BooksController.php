<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Book;
use illuminate\support\Facades\Session;


class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder  $htmlBuilder)
    {
        if ($request->ajax()) {
            $books = Book::with('author');
            return Datatables::of($books)
            ->addColumn('action', function($book){
                return view('datatable._action',[
                    'model'          =>$book,
                    'form_url'       => route('books.destroy', $book->id),
                    'edit_url'       => route('books.edit', $book->id),
                    'confirm_message' => 'yakin mau menghapus ' . $book->title . '?']);
            })->make(true);

            }

            $html = $htmlBuilder
            ->addColumn(['data' => 'title','name'=>'title','title'=>'judul'])
            ->addColumn(['data' => 'amount','name'=>'amount','title'=>'jumlah'])
            ->addColumn(['data' => 'author.name','name'=>'author.name','title'=>'penulis'])
            ->addColumn(['data' => 'action','name'=>'action','title'=>'', 'orderable'=>false,'searchable'=>false]);

                    return view('books.index')->with(compact('html'));
        }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     =>'required|unique:books,title',
            'author_id' =>'required|exists:authors,id',
            'amount'    =>'required|numeric',
            'cover'     =>'image|max:2048'
            ]);

        $book = Book::create($request->except('cover'));

        // isi field cover jika ada cover yang di upload

        if($request->hasfile('cover')) {
            // mengambil fiel yang di upload
            $uploaded_cover = $request->file('cover');

            // mengamibil extension file
            $extension = $uploaded_cover =$request->file('cover');

            // membuat nama file rendom berikut extension
            $filename = md5(time()) .'.' .$extension;

            //menyimpan cover ke folder publlic
            $destinationpath =public_path() . DIRECTORY_SEPARATOR . 'img';
            $uploaded_cover->move($destinationpath, $filename);

            //mengisi file cover di book dengan file name yang baru di buat
            $book->cover =$filename;
            $book->save();
        }
        Session::flash("flash_notification", [
        "level"=> "success",
        "massage"=>"berhasil menyimpan $book->title"]);
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
