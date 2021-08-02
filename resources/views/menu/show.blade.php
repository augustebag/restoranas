@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{$menu->title}}</div>
        <div class="card-body">
          <div class="form-group list-container__photo">
            <label>Photo</label>@if($menu->photo)
            <img src="{{$menu->photo}}">
            @else
            <img src="{{asset('no-img.png')}}">
            @endif
          </div>
          <div class="form-group">
            <label>Title</label>
            <small class="form-text text-muted">{{$menu->title}}</small>
          </div>
          <div class="form-group">
            <label>Price</label>
            <small class="form-text text-muted"> {{$menu->price}}</small>
          </div>
          <div class="form-group">
            <label>Weight</label>
            <small class="form-text text-muted"> {{$menu->weight}}</small>
          </div>
          <div class="form-group">
            <label>Meat</label>
            <small class="form-text text-muted"> {{$menu->meat}}</small>
          </div>
          <div class="form-group">
            <label>About</label>
            <small class="form-text text-muted"> {{$menu->about}}></small>
          </div>
          <a href="{{route('menu.edit',[$menu])}}" class="btn btn-outline-dark btn-sm">Edit</a>
          <a href="{{route('menu.pdf',[$menu])}}" class="btn btn-outline-dark btn-sm">PDF</a>
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

@section('title') MENUS @endsection