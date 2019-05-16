@extends('layouts.content')
@section('content')
    <h2>Edit {{ $publisher->title }}</h2>
    <form method="post" action="{{ route('update_publisher', $publisher->id) }}">
        @CSRF
        @method('POST')
        <div class="form-group">
            <label for="title">Title Of Publisher</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $publisher->title }}">
        </div>
        <div class="form-group">
            <label for="url">URL</label>
            <input type="text" class="form-control" id="url" name="url" value="{{ $publisher->url }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endsection