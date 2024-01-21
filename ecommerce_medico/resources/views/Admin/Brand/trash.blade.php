@extends('Admin.layout')
@section('title')
All Brands
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Recent Payments Queue</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-responsive-md">
                <thead>
                    <tr>
                        <th style="width:80px;"><strong>#</strong></th>
                        <th><strong>Image</strong></th>
                        <th><strong>Name</strong></th>
                        <th><strong>Action</strong></th>   </tr>
                </thead>
                <tbody>
                    @foreach ($data['brand'] as $brand)
                        <tr>
                        <td><strong>{{ $loop->iteration }}</strong></td>
                        <td><img src="{{ $brand->image }}" style="width: 50px; height:50px; object-fit:contain;" alt=""></td>
                        <td>{{ $brand->name }}</td>
                        <td>
                        <div class="dropdown">
                        <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href={{route('brands.restore' , $brand->id)}}">Restore</a>
                            <a class="dropdown-item"href={{route('brands.destroy' , $brand->id)}}">Delete</a>
                        </div>
                        </div>
                        </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            {{ $data['brand']->links() }}
        </div>
    </div>
</div>
@endsection
