@extends('Admin.layout')
@section('title')
All Categories
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Categories</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-responsive-md">
                <thead>
                    <tr>
                        <th style="width:80px;"><strong>#</strong></th>

                        <th><strong>Category Name</strong></th>
                        <th><strong>Name</strong></th>
                        <th><strong>Action</strong></th>   </tr>
                </thead>
                <tbody>
                    @foreach ($data['category'] as $category)
                        <tr>
                        <td><strong>{{ $loop->iteration }}</strong></td>

                        <td>{{ @$category->category->name }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                        <div class="dropdown">
                        <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('subcategory.create' , $category->id)}}">Edit</a>
                            <a class="dropdown-item" href="{{route('subcategory.delete' , $category->id)}}">Delete</a>
                        </div>
                        </div>
                        </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            {{ $data['category']->links() }}
        </div>
    </div>
</div>
@endsection
