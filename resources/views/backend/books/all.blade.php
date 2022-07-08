@extends('layout.admin')
@section('pageTitle','All Books')
@section('content')
{{--  dataTable Css and Js  --}}
<link rel="stylesheet" href="{{ asset('DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}" />
<script src="{{ asset('DataTables-1.10.16/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<div class="col-sm-12 mb-4">
    <h3 class="border-bottom pb-1 mb-2">All Books
        <a href="{{ url('admin/book/add') }}" class="float-right badge badge-success"><i class="fa fa-plus"></i> Add</a>
    </h3>
</div>
{{--  DataTable Content Start  --}}
<div class="col-sm-12 mb-4">
@if(Session::has('success'))
    <p class="alert alert-success">{{ session('success') }}</p>
@endif
    <table class="table table-bordered table-hover" id="dataTable">
        <thead>
            <tr class="bg-light">
                <th>S.No</th>
                <th>Name</th>
                <th>Img</th>
                <th>Price</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Publish On</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($books)>0)
                @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->book_name }}</td>
                    <td><img width="50" src="{{ asset('storage/books/'.$book->book_cover_img) }}" alt="{{ $book->book_name }}"></td>
                    <td>{{ $book->book_price }}</td>
                    <td>{{ $book->book_author }}</td>
                    <td>{{ $book->book_publisher }}</td>
                    <td>{{ $book->book_publish_date }}</td>
                    <td>
                        <a href="{{ url('admin/book/update/'.$book->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                        <a onclick="return confirm('Are you sure to delete this?')" href="{{ url('admin/book/delete/'.$book->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            @endif
            
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function(){
        $("#dataTable").dataTable();
    });
</script>
@endsection