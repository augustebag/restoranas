@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Edit</div>

        <div class="card-body">
          <form method="POST" action="{{route('restaurant.update',[$restaurant])}}">
            <div class="form-group">
              <label>Title:</label>
              <input type="text" class="form-control" name="restaurant_title" value="{{old('restaurant_title', $restaurant->title)}}">
              <small class="form-text text-muted">Title.</small>
            </div>

            <div class="form-group">
              <label>Customers:</label>
              <input type="text" class="form-control" name="restaurant_customers"
                value="{{old('restaurant_customers', $restaurant->customer)}}">
              <small class="form-text text-muted">Customers.</small>
            </div>

            <div class="form-group">
              <label>Employees:</label>
              <input type="text" class="form-control" name="restaurant_employees" value="{{old('restaurant_employees', $restaurant->employees)}}">
              <small class="form-text text-muted">Employees.</small>
            </div>
  
            <select name="menu_id">
              @foreach ($menus as $menu)
              <option value="{{$menu->id}}">{{$menu->title}}</option>
                {{$menu->title}} {{$menu->customers}}
              </option>
              @endforeach
            </select>
            @csrf
            <button type="submit" class="btn btn-outline-dark btn-sm">EDIT</button>
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