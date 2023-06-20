<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Dispatcher signup page</h3>
    <form action="/dispatcher/signup" method="post">
        @csrf
        <input type="text" name="name" placeholder="Full name"><br><br>
        <input type="text" name="phone" placeholder="Phone number"><br><br>
        <input type="email" name="email" placeholder="Email"><br><br>
    <form action="{{ route('user.order') }}" method="post">
        @csrf
        <select name="location" id="">
            <option value=""></option>
            <option value="lagos">Lagos</option>
            <option value="oyo">Oyo</option>
            <option value="ogun">Ogun</option>
            <option value="kwara">Kwara</option>
            <option value="ondo">Ondo</option>
            <option value="osun">Osun</option>
            <option value="ekiti">Ekiti</option>
            <option value="kogi">Kogi</option>
            <option value="abuja">Abuja</option>
            <option value="kano">Kano</option>
        </select><br><br>
        <input type="text" name="lga" placeholder="LGA of delivery"><br><br>
        <input type="text" name="address" placeholder="Delivery address"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <input type="password" name="password_confirmation" placeholder="Confirm Password"><br><br>
        <button type="submit">Signup</button>
    </form>
    <p>Already have an account? <a href="{{ route('dispatcher.login') }}">Login</a></p>
</body>
</html>