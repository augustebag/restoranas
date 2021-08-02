@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Menu</div>
                <div class="card-body">
                    <form method="POST" action="{{route('menu.store')}}" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Tile:</label>
                            <input type="text" class="form-control" name="menu_title" value="{{old('menu_title')}}">
                            <small class="form-text text-muted">Title.</small>
                        </div>

                        <div class="form-group">
                            <label>Price:</label>
                            <input type="text" class="form-control" name="menu_price" value="{{old('menu_price')}}">
                            <small class="form-text text-muted">Price.</small>
                        </div>

                        <div class="form-group">
                            <label>Weight:</label>
                            <textarea type="text" class="form-control" name="menu_weight" id="summernote"
                                value="{{old('menu_weight')}}"></textarea>
                            <small class="form-text text-muted">Weight.</small>
                        </div>

                        <div class="form-group">
                            <label>Meat:</label>
                            <textarea type="text" class="form-control" name="menu_meat" id="summernote"
                                value="{{old('menu_meat')}}"></textarea>
                            <small class="form-text text-muted">Meat.</small>
                        </div>

                        <div class="form-group">
                            <label>Photo</label>
                            <input type="file" class="form-control" name="menu_photo">
                            <small class="form-text text-muted">Upload photo</small>
                        </div>

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
@section('title') Menus @endsection