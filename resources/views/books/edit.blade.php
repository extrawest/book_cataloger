@extends('layouts.content')
@section('content')
    <h2>Add new book</h2>
    <form method="post" action="{{ route('update_book', [$book->id]) }}">
        @CSRF
        @method('POST')
        <div class="form-group">
            <label for="nameOfBook">Name Of Book</label>
            <input type="text" class="form-control" id="nameOfBook" name="title" value="{{ $book->title }}">
        </div>
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn }}">
        </div>
        <div class="form-group">
            <label for="countOfPages">Count Of Pages</label>
            <input type="text" class="form-control" id="countOfPages" name="count_of_pages" value="{{ $book->count_of_pages }}">
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <select id="author" class="form-control" name="author">
                @foreach($authors as $author)
                    <option @if($author->id == $book->user_id) selected @endif value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach    
            </select>
        </div>
        <div class="form-group">
            <label for="publisher">Publishers</label>
            <select id="publisher" class="form-control" name="publisher">
                @foreach($publishers as $publisher)
                    <option @if($publisher->id == $book->publishers_id) selected @endif value="{{ $publisher->id }}">{{ $publisher->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endsection