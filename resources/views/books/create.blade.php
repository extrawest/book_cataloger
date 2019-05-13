@extends('layouts.content')
@section('content')
    <h2>Add new book</h2>
    <form method="post" action="{{ route('store_book') }}">
        @CSRF
        @method('POST')
        <div class="form-group">
            <label for="nameOfBook">Name Of Book</label>
            <input type="text" class="form-control" id="nameOfBook" name="title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn') }}">
        </div>
        <div class="form-group">
            <label for="countOfPages">Count Of Pages</label>
            <input type="text" class="form-control" id="countOfPages" name="count_of_pages" value="{{ old('count_of_pages') }}">
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <select id="author" class="form-control" name="author">
                <option selected>Choose...</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach    
            </select>
        </div>
        <div class="form-group">
            <label for="publisher">Publishers</label>
            <select id="publisher" class="form-control" name="publisher">
                <option selected>Choose...</option>
                @foreach($publishers as $publisher)
                    <option value="{{ $publisher->id }}">{{ $publisher->title }}</option>
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