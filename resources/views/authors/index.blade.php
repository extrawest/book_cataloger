@extends('layouts.content')
@section('content')
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            @if(!auth()->user()->is_author)
                <th scope="col">Action</th>
            @endif
        </tr>
        </thead>
        <tbody>
    @foreach($authors as $index => $author)
        <tr scope="row">
            <td>{{ $author->name }}</td>
            <td>{{ $author->email }}</td>
            @if(!auth()->user()->is_author)
            <td>
                    <a href="{{ route('edit_author', [$author->id]) }}"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('delete_author', [$author->id]) }}"><i class="fa fa-trash"></i></a>
                    <a href="{{ route('show_author', [$author->id]) }}"><i class="fa fa-eye"></i></a>
                </td>
            @endif
        </tr>
    @endforeach
        </tbody>
    </table>
@if($authors instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="row">
        <div class="col-xs-12">
            <div class="paginate">
                {{ $authors->links() }}
            </div>
        </div>
    </div>
@endif
@endsection