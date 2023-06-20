<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>You are welcome as: {{ Auth::guard('dispatcher')->user()->name }} - {{ Auth::guard('dispatcher')->user()->email }}</p><br>
    <a href="{{ route('dispatcher.logout') }}">Logout</a>
    @if($orderDispatchers->count() > 0)
    <h3>You have an order!</h3>
    <div>
        <table>
            @foreach($orderDispatchers as $orderDispatcher)
            <thead>
                <tr>
                    <th>OrderID</th>
                    <th>Destination</th>
                    <th>Weight</th>
                    <th>User's name</th>
                    <th>User's contact</th>         
                @if(!$orderDispatcher->accepted)
                    <th>Accept</th>               
                    <th>Decline</th>
                @else
                    <th>Delivered</th>
                @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $orderDispatcher->orders->orderID }}</td>
                    <td>{{ $orderDispatcher->orders->destination }}</td>
                    <td>{{ $orderDispatcher->orders->weight }}</td>
                    <td>{{ $orderDispatcher->users->name }}</td>
                    <td>{{ $orderDispatcher->users->phone }}</td>         
                @if(!$orderDispatcher->accepted)
                    <td>
                        <a href="{{ route('notification.accept', $orderDispatcher->orders->id) }}">Accept</a>
                    </td>
                    <td>
                        <button><a href="/notification/decline/{{ $orderDispatcher->orders->id }}/{{ $orderDispatcher->dispatchers->id }}/{{ $orderDispatcher->users->id }}">Decline</a></button>
                    </td>
                @else
                    <td>
                        <button><a href="/notification/delivered/{{ $orderDispatcher->orders->id }}/{{ $orderDispatcher->dispatchers->id }}">Delivered</a></button>
                    </td>
                @endif
            </tr>
            </tbody>
            @endforeach  
        </table>
    </div>
    @else
        <p>You do not have any order</p>
    @endif

</body>
</html>