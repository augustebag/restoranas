@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">New Restaurant</div>

        <div class="card-body">
          <form method="POST" action="{{route('restaurant.store')}}">
            <div class="form-group">
              <label>Title:</label>
              <input type="text" class="form-control" name="restaurant_title" value="{{old('restaurant_title')}}">
              <small class="form-text text-muted">Title.</small>
            </div>

            <div class="form-group">
              <label>Customers:</label>
              <input type="text" class="form-control" name="restaurant_customers" value="{{old('restaurant_cutomers')}}">
              <small class="form-text text-muted">Customers.</small>
            </div>

            <div class="form-group">
              <label>Employees:</label>
              <input type="text" class="form-control" name="restaurant_employees" value="{{old('restaurant_employees')}}">
              <small class="form-text text-muted">Employees.</small>
            </div>

            <select name="menu_id">
              @foreach ($menus as $menu)
              <option value="{{$menu->id}}">{{$menu->title}}</option>
              @endforeach
            </select>
            @csrf
            <button type="submit" class="btn btn-outline-dark btn-sm">ADD</button>
          </form>
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