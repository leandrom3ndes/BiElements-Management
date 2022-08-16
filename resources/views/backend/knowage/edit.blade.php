@extends('layout.admin')
@section('pageTitle','Editar Knowage document')
@section('content')
<div class="col-sm-12 mb-4">
    <h3 class="border-bottom pb-1 mb-2">Editar knowage
        <a href="{{ url('admin/knowage') }}" class="float-right badge badge-success"><i class="fa fa-long-arrow-left"></i> Knowage</a>
    </h3>
</div>
{{--  DataTable Content Start  --}}
<div class="col-sm-12 mb-4">
    @if(Session::has('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    <form method="post" action="{{ url('admin/knowage/update/'.$allData->id) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <table class="table table-bordered">
        <tr>
            <th>Label do documento</th>
            <td>
                <input type="text" value="{{ $allData->documentLabel }}" name="documentLabel" class="form-control" placeholder="Insira o label deste documento" />
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
                <input type="text" value="{{ $allData->documentName }}" name="documentName" class="form-control" placeholder="Insira um nome para este documento" />
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
                <img width="100" src="{{ asset('storage/knowages/'.$allData->knowage_cover_img) }}" alt="">
                <input type="hidden" name="prev_img" value="{{ $allData->knowage_cover_img }}">
                @if($errors->has('knowage_cover_img'))
                @foreach($errors->get('knowage_cover_img') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Bielement base64</th>
            <td>
                <textarea name="knowage_base64" class="form-control" placeholder="Insira a codificação base64 para da imagem deste documento" id="" cols="5" rows="5">{{ $allData->knowage_base64 }}</textarea>
                @if($errors->has('knowage_base64'))
                @foreach($errors->get('knowage_base64') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Tipo do documento</th>
            <td>
                <input type="text" value="{{ $allData->documentType }}" name="documentType" class="form-control" placeholder="Insira o tipo deste documento" />
                @if($errors->has('documentType'))
                @foreach($errors->get('documentType') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
            @endif
            </td>
        </tr>
        <tr>
            <th>Role do documento</th>
            <td>
                <textarea name="executionRole" placeholder="Insira um role para este documento" class="form-control" cols="30" rows="10">{{ $allData->executionRole }}</textarea>
                @if($errors->has('executionRole'))
                @foreach($errors->get('executionRole') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
            @endif
            </td>
        </tr>
        <tr>
            <th>Decrição do documento</th>
            <td>
                <textarea name="documentDescription" class="form-control" placeholder="Insira uma descrição para este documento" cols="30" rows="10">{{ $allData->documentDescription }}</textarea>
                @if($errors->has('documentDescription'))
                @foreach($errors->get('documentDescription') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Dataset do documento</th>
            <td>
                <input type="text" value="{{ $allData->datasetLabel }}" name="datasetLabel" class="form-control" placeholder="Insira o label deste dataset" />
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
                <input type="text" value="{{ $allData->displayToolbar }}" name="displayToolbar" class="form-control" placeholder="true ou false" />

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
                <input type="text" value="{{ $allData->canResetParameters }}" name="canResetParameters" class="form-control" placeholder="true ou false" />

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
                <input type="text" value="{{ $allData->displaySliders }}" name="displaySliders" class="form-control" placeholder="true ou false" />

                @if($errors->has('displaySliders'))
                @foreach($errors->get('displaySliders') as $message)
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