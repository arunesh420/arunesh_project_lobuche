<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
</head>
<body>
<form method="post" action="{{action([\App\Http\Controllers\PagesController::class,'store'])}}" enctype="multipart/form-data">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" required>
    <label>Address:</label>
    <input type="text" name="address" required>
    <lebel>age:</lebel>
    <input type="number" name="age" required>
    <label>Image</label>
    <input type ="file" name="image" />
    <input type="submit">
</form>
</body>
</html>



