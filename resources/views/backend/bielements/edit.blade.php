@extends('layout.admin')
@section('pageTitle','Edit Bielement')
@section('content')
<div class="col-sm-12 mb-4">
    <h3 class="border-bottom pb-1 mb-2">Edit Bielement
        <a href="{{ url('admin/bielements') }}" class="float-right badge badge-success"><i class="fa fa-long-arrow-left"></i> BiElements</a>
    </h3>
</div>
{{--  DataTable Content Start  --}}
<div class="col-sm-12 mb-4">
    @if(Session::has('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    <form method="post" action="{{ url('admin/bielement/update/'.$allData->eng_id) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <table class="table table-bordered">
        <tr>
            <th>Bielement Engine</th>
            <td>
                <select name="eng_id" id="" class="form-control">
                    <option value="">--- Select Option ---</option>
                    @if(count($engines)>0)
                        @foreach($engines as $cat)
                        @if($cat->eng_id==$allData->eng_id)
                        <option selected value="{{ $cat->eng_id }}">{{ $cat->eng_name }}</option>
                        @else
                        <option value="{{ $cat->eng_id }}">{{ $cat->eng_name }}</option>
                        @endif
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
            <th>Bielement Name</th>
            <td>
                <input type="text" value="{{ $allData->bi_name }}" name="bi_name" class="form-control" placeholder="Enter Bielement Name" />
                @if($errors->has('bi_name'))
                @foreach($errors->get('bi_name') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
            @endif
            </td>
        </tr>
        <tr>
            <th>Bielement type</th>
            <td>
                <input type="text" value="{{ $allData->bi_type }}" name="bi_type" class="form-control" placeholder="Enter Bielement Price" />
                @if($errors->has('bi_type'))
                @foreach($errors->get('bi_type') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Bielement Image</th>
            <td>
                <input type="file" name="bi_cover_img" />
                <input type="hidden" name="prev_img" value="{{ $allData->bi_cover_img }}">
                <img width="100" src="{{ asset('storage/bielements/'.$allData->bi_cover_img) }}" alt="">
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
                <input type="text" value="{{ $allData->bi_embed }}" name="bi_embed" class="form-control" placeholder="Insira o código iframe" />
                @if($errors->has('bi_embed'))
                @foreach($errors->get('bi_embed') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Bielement base64</th>
            <td>
                <textarea name="bi_base64" class="form-control" placeholder="Enter Bielement Description" id="" cols="5" rows="5">{{ $allData->bi_base64 }}</textarea>
                @if($errors->has('bi_base64'))
                @foreach($errors->get('bi_base64') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Bielement Publisher</th>
            <td>
                <input type="text" value="{{ $allData->bi_creator }}" name="bi_creator" class="form-control" placeholder="Insira Bielement Publisher" />
                @if($errors->has('bi_creator'))
                @foreach($errors->get('bi_creator') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Bielement Publish Date</th>
            <td>
                <input type="date" value="{{ $allData->bi_publish_date }}" name="bi_publish_date" class="form-control" placeholder="Insira Bielement Publish Date" />
                @if($errors->has('bi_publish_date'))
                @foreach($errors->get('bi_publish_date') as $message)
                <p class="p-0 text-danger">{{ $message }}</p>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Bielement Description</th>
            <td>
                <textarea name="bi_desc" class="form-control" placeholder="Enter Bielement Description" id="" cols="30" rows="10">{{ $allData->bi_desc }}</textarea>
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