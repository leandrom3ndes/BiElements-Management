@extends('layout.admin')
@section('pageTitle','Adicionar knowage document')
@section('content')
<div class="col-sm-12 mb-4">
    <h3 class="border-bottom pb-1 mb-2">Adicionar knowage
        <a href="{{ url('admin/knowage') }}" class="float-right badge badge-success"><i class="fa fa-long-arrow-left"></i> Knowage Documents</a>
    </h3>
</div>
{{--  DataTable Content Start  --}}
<div class="col-sm-12 mb-4">
    @if(Session::has('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    <form method="post" action="{{ url('admin/knowage/add') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <table class="table table-bordered">
        <tr>
            <th>Label do documento</th>
            <td>
                <input type="text" name="documentLabel" class="form-control" placeholder="Insira o nome do Label do documento" />
                @if($errors->has('documentLabel'))
                @foreach($errors->get('documentLabel') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
            @endif
            </td>
        </tr>
        <tr>
            <th>Nome do documento</th>
            <td>
                <input type="text" name="documentName" class="form-control" placeholder="Insira um nome para este documento" />
                @if($errors->has('documentName'))
                @foreach($errors->get('documentName') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
            @endif
            </td>
        </tr>
        <tr>
            <th>Imagem do documento</th>
            <td>
                <input type="file" name="knowage_cover_img" />
                @if($errors->has('knowage_cover_img'))
                @foreach($errors->get('knowage_cover_img') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Tipo do documento</th>
            <td>
                <input type="text" name="documentType" class="form-control" placeholder="Insira um nome para este documento" />
                @if($errors->has('documentType'))
                @foreach($errors->get('documentType') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
            @endif
            </td>
        </tr>
        <tr>
            <th>Descrição documento</th>
            <td>
                <textarea name="documentDescription" placeholder="Insira uma descrição para este documento" class="form-control" cols="30" rows="10"></textarea>
                @if($errors->has('documentDescription'))
                @foreach($errors->get('documentDescription') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
            @endif
            </td>
        </tr>
        <tr>
            <th>Role do documento</th>
            <td>
                <input type="text" name="executionRole" class="form-control" placeholder="Insira um role para este documento" />
                @if($errors->has('executionRole'))
                @foreach($errors->get('executionRole') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
            @endif
            </td>
        </tr>
        <tr>
            <th>Dataset do documento</th>
            <td>
                <input type="text" name="datasetLabel" class="form-control" placeholder="Insira o nome do label do dataset deste documento" />
                @if($errors->has('datasetLabel'))
                @foreach($errors->get('datasetLabel') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
            @endif
            </td>
        </tr>
        <tr>
            <th>Mostrar barra de ferramentas</th>
            <td>
                <select name="displayToolbar" class="form-control">
                    <option value="">--- Selecionar Opção ---</option>
                    <option value="true">Sim</option>
                    <option value="false">Não</option>
                </select>
                @if($errors->has('displayToolbar'))
                @foreach($errors->get('displayToolbar') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Permitir reposição de parâmetros</th>
            <td>
                <select name="canResetParameters" class="form-control">
                    <option value="">--- Selecionar Opção ---</option>
                    <option value="true">Sim</option>
                    <option value="false">Não</option>
                </select>
                @if($errors->has('canResetParameters'))
                @foreach($errors->get('canResetParameters') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Mostrar barra de visualização</th>
            <td>
                <select name="displaySliders" class="form-control">
                    <option value="">--- Selecionar Opção ---</option>
                    <option value="true">Sim</option>
                    <option value="false">Não</option>
                </select>
                @if($errors->has('displaySliders'))
                @foreach($errors->get('displaySliders') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Adicionar" class="btn btn-danger">
            </td>
        </tr>
    </table>
    </form>
</div>
@endsection