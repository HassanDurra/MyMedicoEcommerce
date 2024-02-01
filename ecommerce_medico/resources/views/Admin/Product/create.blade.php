@extends('Admin.layout')
@section('title')
@if($data['action'] == 'create')
Add Product
@else
Edit Product
@endif
@endsection

@section('content')
@php
    $action = $data['action'];
    if($action == 'create'){
        $parentRoute = Route('product.store');
        $parentButton = 'Add product';
    }
    if($action=='edit'){
        $parentRoute = Route('product.update' , $data['product']->id);
        $parentButton = 'Update product';
    }

@endphp

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Products Managment</h4>
    </div>
    <div class="card-body">
        <div class="basic-form">
            <form action="{{ $parentRoute }}" method="post" id="productForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Product Image</label>
                        <input type="file"  name="image" class="form-control" placeholder="1234 Main St">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Product Sub Image</label>
                        <input type="file" name="subimage[]" multiple class="form-control" placeholder="Brand Image">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name"  class="form-control" placeholder="Product Name">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Product Price</label>
                        <input type="number" name="price"  class="form-control" placeholder="Product Price">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Product Quantity</label>
                        <input type="number" name="quantity"  class="form-control" placeholder="Product Quantity">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Product Brand</label>
                        <select  name="brand_id"  class="form-control" placeholder="Product Quantity">
                            <option value="">-- Select Brand --</option>
                            @foreach ($data['brand'] as $brand )
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Product Category</label>
                        <select  name="category_id"  class="form-control" placeholder="Product Quantity">
                            <option value="">-- Select Category --</option>
                            @foreach ($data['category'] as $category )
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Product Sub Category</label>
                        <select  name="subcategory_id"  class="form-control" placeholder="Product Quantity">
                            <option value="">-- Select Category First --</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Product Description</label>
                     <textarea name="description" id="" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">{{ $parentButton }}</button>
            </form>
        </div>
    </div>
</div>
<!-- Required vendors -->
<script src="{{ asset("Dashboard/vendor/global/global.min.js") }}"></script>

<script src="{{ asset("Dashboard/vendor/jquery-nice-select/js/jquery.nice-select.min.js") }}"></script>

<!-- Apex Chart -->

<script src="{{ asset("Dashboard/vendor/apexchart/apexchart.js") }}"></script>


<!-- Chart piety plugin files -->


<!-- Dashboard 1 -->
<script src="{{ asset("Dashboard/js/dashboard/dashboard-1.js") }}"></script>

<script src="{{ asset("Dashboard/vendor/owl-carousel/owl.carousel.js") }}"></script>
<script src="{{ asset("Dashboard/vendor/bootstrap-datetimepicker/js/moment.js") }}"></script>
<script src="{{ asset("Dashboard/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js") }}"></script>


<script src="{{ asset("Dashboard/js/custom.min.js") }}"></script>
<script src="{{ asset("Dashboard/js/dlabnav-init.js") }}"></script>
<script src="{{ asset("Dashboard/js/demo.js") }}"></script>
<script src="{{ asset("Dashboard/js/styleSwitcher.js") }}"></script>
<script src="{{ asset("Dashboard/vendor/toastr/js/toastr.min.js") }}"></script>
<script>
let action = "{{ $data['action'] }}";
let product = <?php echo(isset($data['product'])) && $data['product'] ? $data['product'] : 0 ;?>;
// Validation And Data
$(document).ready(function(){
    let name     = $('input[name="name"]');
    let image    = $('input[name="image"]');
    let subimage = $('input[name="subimage"]');
    let price    = $('input[name="price"]');
    let quantity = $('input[name="quantity"]');
    let brand    = $('select[name="brand_id"]');
    let category = $('select[name="category_id"]');
    let subcategory = $('select[name="subcategory_id"]');
    let description = $('textarea[name="description"]');
    let productForm = $('#productForm');
    if(action == 'edit'){
        $(name).val(product.name)
        $(price).val(product.price)
        $(quantity).val(product.quantity)
        $(brand).val(product.brand_id)
        $(category).val(product.category_id)
        $(subcategory).html(`<option value="${product.subcategory_id}">${product.subcategory.name}</option>`);
        $(description).val(product.description)
    }

$(productForm).submit(function(e){
    if(action == 'create'){
    if($(image).val() == ""){
        e.preventDefault();
        toastr['error']("Image is Required..!");
        return false;
    }
    if($(subimage).val() == ""){
        e.preventDefault();
        toastr['error']("Sub Image is Required..!");
        return false;
    }
  }
  if(name.val() == ""){
        e.preventDefault();
        toastr['error']("Name is Required..!");
        return false;
  }
  if(price.val() == ""){
        e.preventDefault();
        toastr['error']("Price is Required..!");
        return false;
  }
  if(quantity.val() == ""){
        e.preventDefault();
        toastr['error']("Quantity is Required..!");
        return false;
  }
  if(brand.val() == ""){
        e.preventDefault();
        toastr['error']("Brand is Required..!");
        return false;
  }
  if(category.val() == ""){
        e.preventDefault();
        toastr['error']("Category is Required..!");
        return false;
  }
  if(subcategory.val() == ""){
        e.preventDefault();
        toastr['error']("Sub Category is Required..!");
        return false;
  }
  if(description.val() == ""){
        e.preventDefault();
        toastr['error']("Description is Required..!");
        return false;
  }
  if(description.val() != "" && description.val().length < 100 ||description.val().length > 1500  ){
        e.preventDefault();
        toastr['error']("Description must be Greater then 100 and less 1500..!");
        return false;
  }
});

let cascadingRoute     = "{{ route('product.subcategory') }}";
$(category).on('change' , function(e){
    e.preventDefault();
    let categoryId = $(this).val();
    $.ajax({
        url : cascadingRoute + "/" + categoryId,
        type: 'get',
        success:function(response){
            let subcategoryData = "";
            $(response).each(function(index, value){
                subcategoryData += `<option value="${value.id}">${value.name}</option>`;
            });
            $(subcategory).html(subcategoryData);
        }
    })
});

});


</script>
@endsection
