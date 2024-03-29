@extends('layouts.content')
@section('content')
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Book</th>
            <th scope="col">Publisher</th>
            <th scope="col">Authors</th>
            <th scope="col">ISBN Code</th>
            <th scope="col">Count of pages</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
    @foreach($books as $index => $book)
        <tr scope="row">
            <td>{{ $book->title }}</td>
            <td>
                    {{ $book->publishers->count() > 0 ? $book->publishers->first()->title : 'Publisher was deleted' }}
            </td>
            <td>
                {{ $book->authors->count() > 0 ? $book->authors->first()->name : 'Author was deleted'}}
            </td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->count_of_pages }}</td>
            <td>
                <a href="{{ route('delete_book', [$book->id]) }}"><i class="fa fa-trash"></i></a>
                <a href="{{ route('edit_book', [$book->id]) }}"><i class="fa fa-edit"></i></a>
            </td>
        </tr>
    @endforeach
        </tbody>
    </table>
    @if($books instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="row">
            <div class="col-xs-12">
                <div class="paginate">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    @endif
@endsection