@extends('layouts.content')
@section('content')
    <h2>Add new Publisher</h2>
    <form method="post" action="{{ route('store_publisher') }}">
        @CSRF
        @method('POST')
        <div class="form-group">
            <label for="title">Title Of Publisher</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="url">URL</label>
            <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endsection