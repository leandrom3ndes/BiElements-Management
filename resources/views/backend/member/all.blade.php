@extends('layout.admin')
@section('pageTitle','All Members')
@section('content')
{{--  dataTable Css and Js  --}}
<link rel="stylesheet" href="{{ asset('DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}" />
<script src="{{ asset('DataTables-1.10.16/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<div class="col-sm-12 mb-4">
    <h3 class="border-bottom pb-1 mb-2">All Members
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
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($allData)>0)
                @foreach($allData as $member)
                <tr>
                    <td>{{ $member->member_id }}</td>
                    <td>{{ $member->member_name }}</td>
                    <td>{{ $member->member_email }}</td>
                    <td>
                        <a onclick="return confirm('Are you sure to delete this?')" href="{{ url('admin/member/delete/'.$member->member_id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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