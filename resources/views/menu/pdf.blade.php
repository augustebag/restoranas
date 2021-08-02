<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PDF</title>
</head>

<body>
  <h1> Title: {{$menu->title}} </h1>
  <div class="form-group">
  </div>
  <div class="form-group">
    <label>Price: </label>
    <small class="form-text text-muted"> {{$menu->price}}</small>
  </div>
  <div class="form-group">
    <label>Weight: </label>
    <small class="form-text text-muted"> {{$menu->weight}}</small>
  </div>
  <div class="form-group">
    <label>Meat: </label>
    <small class="form-text text-muted"> {{$menu->meat}}</small>
  </div>
  <div class="form-group">
    <label> About: </label>
    <small class="form-text text-muted"> {{$menu->about}}</small>
  </div>
</body>

</html>
