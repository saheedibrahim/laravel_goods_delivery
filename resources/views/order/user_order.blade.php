<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>We are at your service, order for your dispatcher</h2>
    @if(session('error'))
     <p>{{ session('error') }}</p>
    @endif
    <form action="{{ route('user.order') }}" method="post">
        @csrf
        <select name="destination" id="">
            <option value="">Select state</option>
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
        <input type="text" name="weight" placeholder="Size of goods in kg">
        <button type="submit">Order</button>
    </form>
</body>
</html>