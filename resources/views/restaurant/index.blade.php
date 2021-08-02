@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h2>Restaurant</h2>
          <div class="row">
            <form action="{{route('restaurant.index')}}" method="get">
              <fieldset>
                <legend>Sort by: </legend>
                <div>
                  <label>Title </label>
                  <input type="radio" name="sort_by" value="title" @if('title'==$sort) checked @endif>

                  <label>Price </label>
                  <input type="radio" name="sort_by" value="price" @if('price'==$sort) checked @endif>
                </div>
              </fieldset>
              <button type="submit" class="btn btn-sm btn-outline-dark">Sort</button>
              <a href="{{route('restaurant.index')}}" class="btn btn-outline-danger btn-sm">Clear</a>
            </form>
            <form action="{{route('restaurant.index')}}" method="get">
              <fieldset>
                <legend>Filter by: </legend>
                <div>
                  <select name="menu_id" class="form-control">
                    @foreach($menus as $menu)
                  <option value="{{$menu->id}}" @if($defaultMenu == $menu->id) selected @endif>
                    {{$menu->title}}
                  </option>
                  @endforeach
                  </select>
                </div>
              </fieldset>
              <button type="submit" class="btn btn-sm btn-outline-dark">Filter</button>
              <a href="{{route('restaurant.index')}}" class="btn btn-outline-danger btn-sm">Clear</a>
            </form>
            <form action="{{route('restaurant.index')}}" method="get" class="sort-form">
              <fieldset>
                <legend>Search: </legend>
                <input type="search" class="form-control mr-sm-2 search" placeholder="Search" aria-label="Search"
                  name="s">
                <button class="btn btn-sm btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
                <a href="{{route('restaurant.index')}}" class="btn btn-sm btn-outline-danger my-2 my-sm-0">Clear</a>
              </fieldset>
            </form>
          </div>
        </div>
      </div>


      <table class="table table-striped table-dark">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Customers</th>
            <th scope="col">Employees</th>
            <th scope="col">Title</th>
            <th scope="col">*</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($restaurants as $restaurant)
          <tr>
            <td>{{$restaurant->title}}</td>
            <td>{{$restaurant->customers}}</td>
            <td>{{$restaurant->employees}}</td>
            <td>{{$restaurant->menuOfRestaurant->title}}</td>
            <td class="list-container__buttons">
              <form method="POST" action="{{route('restaurant.destroy', [$restaurant])}}">
                @csrf
                <a href="{{route('restaurant.show',[$restaurant])}}" class="btn btn-outline-success btn-sm">More info</a>
                <a href="{{route('restaurant.edit',[$restaurant])}}" class="btn btn-outline-success btn-sm">Edit</a>
                <button type="submit" class="btn btn-outline-danger btn-sm">DELETE</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$restaurants->links()}}
    </div>
  </div>
</div>
@endsection
