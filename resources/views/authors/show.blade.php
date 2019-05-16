@extends('layouts.content')
@section('content')
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>
        <tr scope="row">
            <td>{{ $author->name }}</td>
            <td>{{ $author->email }}</td>
        </tr>
        </tbody>
    </table>
    <p style="font-size: 10px;">{{ $author->remember_token }}</p>
@endsection
