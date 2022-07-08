@extends('layout.admin')
@section('pageTitle','Admin Dashboard')
@section('content')
<div class="col-sm-12">
    <h3 class="border-bottom pb-1 mb-4">Dashboard</h3>
</div>
{{--  Dashboard Widget  --}}
<div class="col-sm-3">
    <div class="card">
        <div class="card-header">
            <h3><a href="{{ url('admin/books') }}">Books</a> <span class="badge badge-secondary">{{ App\Book::count() }}</span></h3>
        </div>
    </div>
</div>
<div class="col-sm-3">
    <div class="card">
        <div class="card-header">
            <h3><a href="{{ url('admin/engines') }}">Engines</a> <span class="badge badge-secondary">{{ App\Engine::count() }}</span></h3>
        </div>
    </div>
</div>
<div class="col-sm-3">
    <div class="card">
        <div class="card-header">
            <h3><a href="{{ url('admin/members') }}">Members</a> <span class="badge badge-secondary">{{ App\Member::count() }}</span></h3>
        </div>
    </div>
</div>
@endsection