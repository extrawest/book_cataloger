@extends('layouts.content')
@section('content')
    <h2>Edit {{ $user->name }}</h2>
    <form method="post" action="{{ route('update_author', [$user->id]) }}">
        @CSRF
        @method('POST')
        <div class="form-group">
            <label for="name">Author name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="email">E-Mail</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endsection