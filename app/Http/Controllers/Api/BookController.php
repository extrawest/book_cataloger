<?php

namespace App\Http\Controllers\Api;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * Class BookController
 *
 * @package App\Http\Controllers\Api
 */
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->json()->all(),
            [
                'title'      =>  'required|min:3',
                'isbn' => 'required|numeric',
                'count_of_pages'  =>  'required|numeric',
                'author'  =>  'required',
                'publisher'  =>  'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $book = Book::create(
            [
                'title'             =>  $request->title,
                'isbn'              =>  $request->isbn,
                'count_of_pages'    =>  $request->count_of_pages,
                'user_id'           =>  $request->author,
                'publisher_id'     =>  $request->publisher
            ]
        );
        return response()->json($book);
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
        $validator = Validator::make($request->json()->all(),
            [
                'title'      =>  'required|min:3',
                'isbn' => 'required|numeric',
                'count_of_pages'  =>  'required|numeric',
                'author'  =>  'required',
                'publisher'  =>  'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $book = Book::find($id);
        $book->title = $request->title;
        $book->isbn = $request->isbn;
        $book->count_of_pages = $request->count_of_pages;
        $book->user_id = $request->author;
        $book->publisher_id = $request->publisher;
        $book->save();

        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if ($book == null) {
            return response()->json(['message' => "This book doesn't exist"]);
        }
        $book->delete();

        return response()->json(['message' => 'Book was deleted successfully']);
    }
}
