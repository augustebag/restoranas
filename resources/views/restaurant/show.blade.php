@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{$restaurant->menuOfRestaurant->title}}</div>
        <div class="card-body">
          <div class="form-group">
            <label>Restaurant Title</label>
            <small class="form-text text-muted">{{$restaurant->title}}</small>
          </div>
          <div class="form-group">
            <label> Customers</label>
            <small class="form-text text-muted">{{$restaurant->customers}}</small>
          </div>
          <div class="form-group">
            <label> Employees</label>
            <small class="form-text text-muted"> {{$restaurant->employees}}</small>
          </div>
          <a href="{{route('restaurant.edit',[$restaurant])}}" class="btn btn-outline-dark btn-sm">Edit</a>
          <a href="{{route('restaurant.pdf',[$restaurant])}}" class="btn btn-outline-dark btn-sm">PDF</a>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
       $('#summernote').summernote();
     });
</script>

@endsection

@section('title') Restaurant @endsection