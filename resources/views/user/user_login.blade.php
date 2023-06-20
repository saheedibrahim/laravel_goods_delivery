<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>User Login Page</h3>   
    @if(session('error'))
    <p>{{session('error')}}</p>
    @endif

    @if(session('success'))
    <p>{{session('success')}}</p>
    @endif
    <form action="{{ route('user.login') }}" method="post">
        @csrf
        <input type="email" name="email" placeholder="Email"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
       <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="{{ route('user.signup') }}">Signup</a></p>
</body>
</html>