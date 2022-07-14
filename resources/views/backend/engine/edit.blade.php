@extends('layout.admin')
@section('pageTitle','Add Engine')
@section('content')
<div class="col-sm-12 mb-4">
    <h3 class="border-bottom pb-1 mb-2">Update Engine
        <a href="{{ url('admin/engines') }}" class="float-right badge badge-success"><i class="fa fa-long-arrow-left"></i> Engines</a>
    </h3>
</div>
{{--  DataTable Content Start  --}}
<div class="col-sm-12 mb-4">
    @if(Session::has('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    <form method="post" action="{{ url('admin/engine/update/'.$allData->eng_id) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <table class="table table-bordered">
        <tr>
            <th>Engine Title</th>
            <td>
                <input type="text" value="{{ $allData->eng_name }}" name="eng_name" class="form-control" placeholder="Enter Engine Name" />
                @if($errors->has('eng_name'))
                @foreach($errors->get('eng_name') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
            @endif
            </td>
        </tr>
        <tr>
            <th>Engine Description</th>
            <td>
                <textarea name="eng_desc" placeholder="Enter Engine Description" class="form-control" cols="30" rows="10">{{ $allData->eng_desc }}</textarea>
                @if($errors->has('eng_desc'))
                @foreach($errors->get('eng_desc') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
            @endif
            </td>
        </tr>
        <tr>
            <th>Engine Image</th>
            <td>
                <input type="file" name="eng_img" />
                <img width="100" src="{{ asset('storage/engs/'.$allData->eng_img) }}" alt="">
                <input type="hidden" name="prev_img" value="{{ $allData->eng_img }}">
                @if($errors->has('eng_img'))
                @foreach($errors->get('eng_img') as $message)
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