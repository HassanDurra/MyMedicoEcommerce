@extends('Admin.layout')
@section('title')
@if($data['action'] == 'create')
Add Sub-Category
@else
Edit Sub-Category
@endif
@endsection

@section('content')
@php
    $action = $data['action'];
    if($action == 'create'){
        $parentRoute = Route('subcategory.store');
        $parentButton = 'Add Category';
    }
    if($action=='edit'){
        $parentRoute = Route('subcategory.store' , $data['subcategory']->id);
        $parentButton = 'Update Category';
    }

@endphp

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Sub-Category Managment</h4>
    </div>
    <div class="card-body">
        <div class="basic-form">
            <form action="{{ $parentRoute }}" method="post" id="subcategoryForm" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Category Name</label>
                        <select name="category_id" id="" class="form-control">
                            <option value="">-- Select Category --</option>
                            @foreach ($data['category'] as $category )
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-12 " id="inputContainer">
                        <div class="inputContainer">
                        <div class="label-container d-flex justify-content-between" >
                            <label class="form-label mt-4">Sub Category Name</label>
                            <button class="btn btn-success btn-sm mb-3 mt-2" id="addButton">Add</button>
                        </div>
                        <input type="text" name="name[]" class="form-control" placeholder="Category Name"></div>
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
let subcategory = <?php echo(isset($data['subcategory'])) && $data['subcategory'] ? $data['subcategory'] : 0 ;?>;
let nameInput = $('input[name="name[]"]');
let catInput = $('select[name="category_id"]');
$("#subcategoryForm").submit(function(e){

  if(catInput.val() == ""){
        e.preventDefault();
        toastr['error']("Category Name is Required..!");
        return false;
  }
  if(nameInput.val() == ""){
        e.preventDefault();
        toastr['error']("Name is Required..!");
        return false;
  }
});
if(action=='edit'){
    catInput.val(subcategory.category_id);
    nameInput.val(subcategory.name);
}
// Add Extra Input
let buttonForAdding  =    $('#addButton');
let inputContainer   =    $('#inputContainer');
$(buttonForAdding).on('click' , function(e){
    e.preventDefault();
    let inputData = `   <div class="inputContainer">
                         <div class="label-container d-flex justify-content-between" >
                            <label class="form-label mt-4">Sub Category Name</label>
                            <button class="btn btn-danger removeButton  btn-sm mb-3 mt-2" >Remove</button>
                        </div>
                        <input type="text" name="name[]" class="form-control" placeholder="Category Name"></div>`;
    $(inputContainer).append(inputData)
});
$(document).on('click' , '.removeButton' , function(e){
    e.preventDefault();
    $(this).closest('.inputContainer').remove();
})

</script>
@endsection
