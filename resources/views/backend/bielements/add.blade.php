@extends('layout.admin')
@section('pageTitle','Add Bielement')
@section('content')
<div class="col-sm-12 mb-4">
    <h3 class="border-bottom pb-1 mb-2">Add Bielement
        <a href="{{ url('admin/bielements') }}" class="float-right badge badge-success"><i class="fa fa-long-arrow-left"></i> BiElements</a>
    </h3>
</div>
{{--  DataTable Content Start  --}}
<div class="col-sm-12 mb-4">
    @if(Session::has('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    <form method="post" action="{{ url('admin/bielement/add') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <table class="table table-bordered">
        <tr>
            <th>Bielement Engine</th>
            <td>
                <select name="eng_id" id="" class="form-control">
                    <option value="">--- Select Option ---</option>
                    @if(count($engines)>0)
                        @foreach($engines as $eng)
                        <option value="{{ $eng->eng_id }}">{{ $eng->eng_name }}</option>
                        @endforeach
                    @endif
                </select>
                @if($errors->has('eng_id'))
                @foreach($errors->get('eng_id') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Bielement Nome</th>
            <td>
                <input type="text" name="bi_name" class="form-control" placeholder="Insira o nome do Bielement" />
                @if($errors->has('bi_name'))
                @foreach($errors->get('bi_name') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Bielement tipo</th>
            <td>
                <select name="bi_type" id="" class="form-control">
                    <option value="">--- Select Option ---</option>
                    <option value="Chart">Chart</option>
                    <option value="Map">Map</option>
                </select>
                @if($errors->has('bi_type'))
                @foreach($errors->get('bi_type') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Bielement Imagem</th>
            <td>
                <input type="file" name="bi_cover_img" />
                @if($errors->has('bi_cover_img'))
                @foreach($errors->get('bi_cover_img') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Bielement embed</th>
            <td>
                <input type="text" name="bi_embed" class="form-control" placeholder="Insira o link para o embed iframe" />
                @if($errors->has('bi_embed'))
                @foreach($errors->get('bi_embed') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Bielement autor</th>
            <td>
                <input type="text" name="bi_creator" class="form-control" placeholder="Insira o nome do autor" />
                @if($errors->has('bi_creator'))
                @foreach($errors->get('bi_creator') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Bielement data de publicação</th>
            <td>
                <input type="date" name="bi_publish_date" class="form-control" placeholder="Insira a data de publicação" />
                @if($errors->has('bi_publish_date'))
                @foreach($errors->get('bi_publish_date') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Bielement descrição</th>
            <td>
                <textarea name="bi_desc" class="form-control" placeholder="Insira uma descrição" id="" cols="30" rows="10"></textarea>
                @if($errors->has('bi_desc'))
                @foreach($errors->get('bi_desc') as $message)
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