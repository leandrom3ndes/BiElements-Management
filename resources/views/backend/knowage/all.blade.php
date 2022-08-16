@extends('layout.admin')
@section('pageTitle','Todos os documentos knowage')
@section('content')
{{--  dataTable Css and Js  --}}
<link rel="stylesheet" href="{{ asset('DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}" />
<script src="{{ asset('DataTables-1.10.16/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<div class="col-sm-12 mb-4">
    <h3 class="border-bottom pb-1 mb-2">Todos os documentos knowage
        <a href="{{ url('admin/knowage/add') }}" class="float-right badge badge-success"><i class="fa fa-plus"></i> Adicionar</a>
    </h3>
</div>
{{--  DataTable Content Start  --}}
<div class="col-sm-12 mb-4">
    <table class="table table-bordered table-hover" id="dataTableKnowage">
        <thead>
            <tr class="bg-light">
                <th>S.No</th>
                <th>Label</th>
                <th>Nome</th>
                <th>Imagem</th>
                <th>Tipo</th>
                <th>Role</th>
                <th>Descrição</th>
                <th>Dataset</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @if(count($allData)>0)
                @foreach($allData as $know)
                <tr>
                    <td>{{ $know->id }}</td>
                    <td>{{ $know->documentLabel }}</td>
                    <td>{{ $know->documentName }}</td>
                    <td><img width="100" src="{{ asset('storage/knowages/'.$know->knowage_cover_img) }}" alt=""></td>
                    <td>{{ $know->documentType }}</td>
                    <td>{{ $know->executionRole }}</td>
                    <td>{{ $know->documentDescription }}</td>
                    <td>{{ $know->datasetLabel }}</td>

                    <td>
                        <a href="{{ url('admin/knowage/update/'.$know->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                        <a onclick="return confirm('Are you sure to delete this?')" href="{{ url('admin/engine/delete/'.$know->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function(){
        $("#dataTableKnowage").dataTable({
            "order":[[0,'desc']]
        });
    });
</script>
@endsection