@extends('layout.admin')
@section('pageTitle','All BiElements')
@section('content')
{{--  dataTable Css and Js  --}}
<link rel="stylesheet" href="{{ asset('DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}" />
<script src="{{ asset('DataTables-1.10.16/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<div class="col-sm-12 mb-4">
    <h3 class="border-bottom pb-1 mb-2">All BiElements
        <a href="{{ url('admin/bielement/add') }}" class="float-right badge badge-success"><i class="fa fa-plus"></i> Add</a>
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
                <th>ID</th>
                <th>Nome</th>
                <th>Imagem</th>
                <th>Engine</th>
                <th>Tipo</th>
                <th>Autor</th>
                <th>Data de publicação</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @if(count($bielements)>0)
                @foreach($bielements as $bielement)
                    <tr>
                        <td>{{ $bielement->id }}</td>
                        <td>{{ $bielement->bi_name }}</td>
                        <td><img width="100" src="{{ asset('storage/bielements/'.$bielement->bi_cover_img) }}" alt="{{ $bielement->bi_name }}"></td>
                        <td>{{ $bielement->eng_id }}</td>
                        <td>{{ $bielement->bi_type }}</td>
                        <td>{{ $bielement->bi_creator }}</td>
                        <td>{{ $bielement->bi_publish_date }}</td>
                        <td>
                            <a href="{{ url('admin/bielement/update/'.$bielement->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                            <a onclick="return confirm('Are you sure to delete this?')" href="{{ url('admin/bielement/delete/'.$bielement->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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