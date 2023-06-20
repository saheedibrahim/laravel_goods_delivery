<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    You are welcome: {{$user->name}} - {{$user->email}}
    <button type="submit" ><a href="{{ route('user.logout') }}">Logout</a></button><br><br>
    <button type="submit"><a href="{{ route('user.order') }}">Order Now</a></button>
    @if( $orderDispatchers->count() > 0 )
        <table>
            <thead>
                <tr>
                    @foreach($orderDispatchers as $orderDispatcher)
                        @if($orderDispatcher->accepted)
                            <th>Dispatcher's name</th>
                            <th>Dispatcher's contact</th>
                            <th>Carry Status</th>
                        @endif
                        @if($orderDispatcher->delivered)
                            <th>Delivery Status</th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($orderDispatchers as $orderDispatcher)
                        @if($orderDispatcher->accepted)
                            <td>{{ $orderDispatcher->dispatchers->name }}</td>
                            <td>{{ $orderDispatcher->dispatchers->phone }}</td>
                            <td>Goods carried, your goods is on the way</td>
                        @elseif( !$orderDispatcher->accepted )
                            <th>Please be patient, a dispatcher would be available shortly!</th>
                        @endif
                        @if( $orderDispatcher->delivered )
                            <td>Cogratulation, your goods as been delivered successfully</td>
                        @endif
                    @endforeach
                </tr>
            </tbody>
        </table>
    @endif
    @if($declinedGoods->count() > 0)
        @foreach($declinedGoods as $declinedGood)
        <p>{{ $declinedGood->message }}</p>
        @endforeach
    @endif
</body>
</html>