<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PDF</title>
</head>

<body>
  <h1> Menu: {{$restaurant->menuOfRestaurant->title}} </h1>
  <div class="form-group">
    <label>Title: </label>
    <small class="form-text text-muted"> {{$restaurant->title}}</small>
  </div>
  <div class="form-group">
    <label> Customers: </label>
    <small class="form-text text-muted"> {{$restaurant->customers}}</small>
  </div>
  <div class="form-group">
    <label> Employees: </label>
    <small class="form-text text-muted"> {{$restaurant->employees}}</small>
  </div>
</body>

</html>