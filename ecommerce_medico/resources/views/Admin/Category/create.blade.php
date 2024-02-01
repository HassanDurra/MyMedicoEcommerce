@extends('Admin.layout')
@section('title')
@if($data['action'] == 'create')
Add Category
@else
Edit Category
@endif
@endsection

@section('content')
@php
    $action = $data['action'];
    if($action == 'create'){
        $parentRoute = Route('category.store');
        $parentButton = 'Add Category';
    }
    if($action=='edit'){
        $parentRoute = Route('category.store' , $data['category']->id);
        $parentButton = 'Update Category';
    }

@endphp

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Category Managment</h4>
    </div>
    <div class="card-body">
        <div class="basic-form">
            <form action="{{ $parentRoute }}" method="post" id="categoryForm" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Category Name">
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
let category = <?php echo(isset($data['category'])) && $data['category'] ? $data['category'] : 0 ;?>;
let nameInput = $('input[name="name"]');
$("#categoryForm").submit(function(e){

  if(nameInput.val() == ""){
        e.preventDefault();
        toastr['error']("Name is Required..!");
        return false;
  }
});
if(action=='edit'){
    nameInput.val(category.name);
}

</script>
@endsection
