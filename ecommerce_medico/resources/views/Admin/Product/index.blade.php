@extends('Admin.layout')
@section('title')
All Product
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
                        <th><strong>Price</strong></th>
                        <th><strong>Stock</strong></th>
                        <th><strong>Category</strong></th>
                        <th><strong>Brand</strong></th>
                        <th><strong>Status</strong></th>
                        <th><strong>Action</strong></th>   </tr>
                </thead>
                <tbody>
                    @foreach ($data['product'] as $product)
                        <tr>
                        <td><strong>{{ $loop->iteration }}</strong></td>
                        <td><img src="{{ asset('Admin/ProductImages/' . $product->image) }}" style="width: 50px; height:50px; object-fit:contain;" alt=""></td>
                        <td>{{ $product->name }}</td>
                        <td>PKR, {{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ @$product->category->name }}</td>
                        <td>{{ @$product->brand->name }}</td>
                        <td>
                            @if($product->is_publised == 0)
                            <a class="btn btn-danger btn-sm" >Un-Published</a>
                            @else
                            <a class="btn btn-success btn-sm" >Published</a>
                            @endif
                        </td>
                        <td>
                        <div class="dropdown">
                        <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                        </button>
                        <div class="dropdown-menu">
                            @if($product->is_publised == 0)
                                <a class="dropdown-item" href="{{route('product.publish' , $product->id)}}">Publish Product</a>
                            @endif
                            <a class="dropdown-item" href="{{route('product.create' , $product->id)}}">Edit</a>
                            <a class="dropdown-item" href="{{route('product.delete' , $product->id)}}">Delete</a>
                        </div>
                        </div>
                        </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            {{ $data['product']->links() }}
        </div>
    </div>
</div>
@endsection
