@extends('Admin.layout')
@section('title')
@if($data['action'] == 'create')
Add Brands
@else
Edit Brand
@endif
@endsection

@section('content')
@php
    $action = $data['action'];
    if($action == 'create'){
        $parentRoute = Route('brands.store');
        $parentButton = 'Add Brand';
    }
    if($action=='edit'){
        $parentRoute = Route('brands.update' , $data['brands']->id);
        $parentButton = 'Update Brand';
    }

@endphp

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Brands Managment</h4>
    </div>
    <div class="card-body">
        <div class="basic-form">
            <form action="{{ $parentRoute }}" method="post" id="brandsForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Brand Image</label>
                        <input type="file"  name="image" class="form-control" placeholder="1234 Main St">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Brand Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Brand Image">
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
let brands = <?php echo(isset($data['brands'])) && $data['brands'] ? $data['brands'] : 0 ;?>;
let nameInput = $('input[name="name"]');
let image     = $("input[name='image']");
$("#brandsForm").submit(function(e){
  if(action == 'create'){
    if($(image).val() == ""){
        e.preventDefault();
        toastr['error']("Image is Required..!");
        return false;
    }
  }
  if(nameInput.val() == ""){
        e.preventDefault();
        toastr['error']("Name is Required..!");
        return false;
  }
});
if(action=='edit'){
    nameInput.val(brands.name);
}

</script>
@endsection
