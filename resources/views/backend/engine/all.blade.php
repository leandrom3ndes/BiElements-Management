@extends('layout.admin')
@section('pageTitle','All Engines')
@section('content')
{{--  dataTable Css and Js  --}}
<link rel="stylesheet" href="{{ asset('DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}" />
<script src="{{ asset('DataTables-1.10.16/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<div class="col-sm-12 mb-4">
    <h3 class="border-bottom pb-1 mb-2">All Engines
        <a href="{{ url('admin/engine/add') }}" class="float-right badge badge-success"><i class="fa fa-plus"></i> Add</a>
    </h3>
</div>
{{--  DataTable Content Start  --}}
<div class="col-sm-12 mb-4">
    <table class="table table-bordered table-hover" id="dataTable">
        <thead>
            <tr class="bg-light">
                <th>S.No</th>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($allData)>0)
                @foreach($allData as $cat)
                <tr>
                    <td>{{ $cat->eng_id }}</td>
                    <td>{{ $cat->eng_name }}</td>
                    <td><img width="100" src="{{ asset('storage/cats/'.$cat->eng_img) }}" alt=""></td>
                    <td>
                        <a href="{{ url('admin/engine/update/'.$cat->eng_id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                        <a onclick="return confirm('Are you sure to delete this?')" href="{{ url('admin/engine/delete/'.$cat->eng_id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function(){
        $("#dataTable").dataTable({
            "order":[[0,'desc']]
        });
    });
</script>
@endsection