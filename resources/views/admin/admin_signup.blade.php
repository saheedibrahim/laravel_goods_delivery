<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Admin signup page</h3>
    <form action="/admin/signup" method="post">
        @csrf
        <input type="text" name="name" placeholder="Full name"><br><br>
        <input type="email" name="email" placeholder="Email"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <input type="password" name="password_confirmation" placeholder="Confirm Password"><br><br>
        <button type="submit">Signup</button>
    </form>
</body>
</html>