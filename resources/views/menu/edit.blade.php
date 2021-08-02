@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit</div>
                <div class="card-body">
                    <form method="POST" action="{{route('menu.update',$menu)}}" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" class="form-control" name="menu_title"
                                value="{{old('menu_name', $menu->title)}}">
                            <small class="form-text text-muted">Title.</small>
                        </div>
                        <div class="form-group">
                            <label>Price:</label>
                            <input type="text" class="form-control" name="menu_price"
                                value="{{old('menu_price', $menu->price)}}">
                            <small class="form-text text-muted">Price.</small>
                        </div>
                        <div class="form-group">
                            <label>Weight:</label>
                            <input type="text" class="form-control" name="menu_weight"
                                value="{{old('menu_weight', $menu->weight)}}">
                            <small class="form-text text-muted">Weight.</small>
                        </div>
                        <div class="form-group">
                            <label>Meat:</label>
                            <input type="text" class="form-control" name="menu_meat"
                                value="{{old('menu_meat', $menu->meat)}}">
                            <small class="form-text text-muted">Meat.</small>
                        </div>
                        <div class="form-group">
                            <div class="small-photo">
                                @if($menu->photo)
                                <img src="{{$menu->photo}}">
                                <label>Delete photo <input type="checkbox" name="delete_menu_photo"></label>
                                @else
                                <img src="{{asset('no-img.png')}}">
                                @endif
                            </div>
                            <label>Photo</label>
                            <input type="file" class="form-control" name="menu_photo">
                            <small class="form-text text-muted">Upload photo</small>
                        </div>
                        <div class="form-group">
                            <label>About:</label>
                            <textarea type="text" class="form-control" name="menu_about"
                                value="{{old('menu_about', $menu->about)}}" id="summernote"></textarea>
                            <small class="form-text text-muted">About.</small>
                        </div>
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
@section('title') Menus @endsection