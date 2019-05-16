<?php

namespace App\Http\Controllers;

use App\Book;
use App\Helpers;
use App\Publisher;
use App\User;
use Illuminate\Http\Request;

/**
 * Class BookController
 *
 * @package App\Http\Controllers
 */
class BookController extends Controller
{
    protected $helpers;
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->helpers = new Helpers();
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
        $this->validate(
            $request,
            [
            'title'      =>  'required|min:3',
            'isbn' => 'required|numeric',
            'count_of_pages'  =>  'required|numeric',
            'author'  =>  'required',
            'publisher'  =>  'required'
            ]
        );
        $book = Book::create(
            [
            'title'             =>  $request->title,
            'isbn'              =>  $request->isbn,
            'count_of_pages'    =>  $request->count_of_pages,
            'user_id'           =>  $request->author,
            'publisher_id'     =>  $request->publisher
            ]
        );

        $this->helpers->logRecorder($book);
        return redirect(route('all_books'));
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
        $this->validate(
            $request,
            [
                'title'      =>  'required|min:3',
                'isbn' => 'required|numeric',
                'count_of_pages'  =>  'required|numeric',
                'author'  =>  'required',
                'publisher'  =>  'required'
            ]
        );

        $book->title = $request->title;
        $book->isbn = $request->isbn;
        $book->count_of_pages =  $request->count_of_pages;
        $book->user_id = $request->author;
        $book->publisher_id = $request->publisher;
        $book->save();
        $this->helpers->logRecorder($book);

        return redirect(route('all_books'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book = Book::find($book->id);

        $this->helpers->logRecorder($book);
        $book->delete();

        return back();
    }
}
