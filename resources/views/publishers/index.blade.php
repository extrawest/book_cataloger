@extends('layouts.content')
@section('content')
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Publisher</th>
            <th scope="col">Url</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
    @foreach($publishers as $index => $publisher)
        <tr scope="row">
            <td>{{ $index + 1 }}</td>
            <td>{{ $publisher->title }}</td>
            <td>{{ $publisher->url }}</td>
            <td>
                <a href="{{ route('edit_publisher', [$publisher->id]) }}"><i class="fa fa-edit"></i></a>
                <a href="{{ route('delete_publisher', [$publisher->id]) }}"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
    @endforeach
        </tbody>
    </table>
@endsection