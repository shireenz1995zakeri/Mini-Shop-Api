<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form method="post" action="{{url('shop')}}">
    {{csrf_field()}}
    <input type="text" name="price">
    <button type="submit">تکمیل خرید</button>
</form>
</body>
</html>
