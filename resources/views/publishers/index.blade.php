@extends('layouts.content')
@section('content')
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Publisher</th>
            <th scope="col">Url</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
    @foreach($publishers as $publisher)
        <tr scope="row">
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
    @if($publishers instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="row">
            <div class="col-xs-12">
                <div class="paginate">
                    {{ $publishers->links() }}
                </div>
            </div>
        </div>
    @endif

@endsection