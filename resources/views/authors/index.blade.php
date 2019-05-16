@extends('layouts.content')
@section('content')
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
                <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
    @foreach($authors as $index => $author)
        <tr scope="row">
            <td>{{ $index + 1 }}</td>
            <td>{{ $author->name }}</td>
            <td>{{ $author->email }}</td>
                <td>
                    <a href="{{ route('edit_author', [$author->id]) }}"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('delete_author', [$author->id]) }}"><i class="fa fa-trash"></i></a>
                    <a href="{{ route('show_author', [$author->id]) }}"><i class="fa fa-eye"></i></a>
                </td>
        </tr>
    @endforeach
        </tbody>
    </table>
@endsection