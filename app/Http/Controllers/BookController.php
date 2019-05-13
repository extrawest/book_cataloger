<?php

namespace App\Http\Controllers;

use App\Book;
use App\Publisher;
use App\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = User::where('is_author', 1)->get();
        $publishers = Publisher::all();
        return view('books.create', compact('authors', 'publishers'));
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
            'title'      =>  'required|min:3',
            'isbn' => 'required|numeric',
            'count_of_pages'  =>  'required|numeric',
            'author'  =>  'required',
            'publisher'  =>  'required'
        ]);
        $book = Book::create([
            'title'             =>  $request->title,
            'isbn'              =>  $request->isbn,
            'count_of_pages'    =>  $request->count_of_pages,
            'user_id'           =>  $request->author,
            'publishers_id'     =>  $request->publisher
        ]);


        return redirect(route('all_books'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = User::all();
        $publishers = Publisher::all();
        return view('books.edit', compact('book', 'authors', 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
