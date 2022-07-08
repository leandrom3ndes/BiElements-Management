@extends('layout.admin')
@section('pageTitle','Add Book')
@section('content')
<div class="col-sm-12 mb-4">
    <h3 class="border-bottom pb-1 mb-2">Add Book
        <a href="{{ url('admin/books') }}" class="float-right badge badge-success"><i class="fa fa-long-arrow-left"></i> Books</a>
    </h3>
</div>
{{--  DataTable Content Start  --}}
<div class="col-sm-12 mb-4">
    @if(Session::has('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    <form method="post" action="{{ url('admin/book/add') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <table class="table table-bordered">
        <tr>
            <th>Book Engine</th>
            <td>
                <select name="book_cat" id="" class="form-control">
                    <option value="">--- Select Option ---</option>
                    @if(count($engines)>0)
                        @foreach($engines as $cat)
                        <option value="{{ $cat->eng_id }}">{{ $cat->eng_name }}</option>
                        @endforeach
                    @endif
                </select>
                @if($errors->has('book_cat'))
                @foreach($errors->get('book_cat') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Book Name</th>
            <td>
                <input type="text" name="book_name" class="form-control" placeholder="Enter Book Name" />
                @if($errors->has('book_name'))
                @foreach($errors->get('book_name') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
            @endif
            </td>
        </tr>
        <tr>
            <th>Book PDF</th>
            <td>
                <input type="file" name="book_pdf" />
                @if($errors->has('book_pdf'))
                @foreach($errors->get('book_pdf') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
            @endif
            </td>
        </tr>
        <tr>
            <th>Book Image</th>
            <td>
                <input type="file" name="book_img" />
                @if($errors->has('book_img'))
                @foreach($errors->get('book_img') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Book Price</th>
            <td>
                <input type="text" name="book_price" class="form-control" placeholder="Enter Book Price" />
                @if($errors->has('book_price'))
                @foreach($errors->get('book_price') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Book Author</th>
            <td>
                <input type="text" name="book_author" class="form-control" placeholder="Enter Book Author" />
                @if($errors->has('book_author'))
                @foreach($errors->get('book_author') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Book Publisher</th>
            <td>
                <input type="text" name="book_publisher" class="form-control" placeholder="Enter Book Publisher" />
                @if($errors->has('book_publisher'))
                @foreach($errors->get('book_publisher') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Book Publish Date</th>
            <td>
                <input type="date" name="book_publish" class="form-control" placeholder="Enter Book Publish Date" />
                @if($errors->has('book_publish'))
                @foreach($errors->get('book_publish') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Book Description</th>
            <td>
                <textarea name="book_desc" class="form-control" placeholder="Enter Book Description" id="" cols="30" rows="10"></textarea>
                @if($errors->has('book_desc'))
                @foreach($errors->get('book_desc') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Add" class="btn btn-danger">
            </td>
        </tr>
    </table>
    </form>
</div>
@endsection