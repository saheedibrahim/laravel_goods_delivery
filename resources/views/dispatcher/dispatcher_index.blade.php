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
    <div>
        <table>
            @foreach($orderDispatchers as $orderDispatcher)
            <thead>
                @if($orderDispatcher->status == 'Pending' || $orderDispatcher->status == 'Accepted')
                {{-- <tr><h3>You have an order!</h3></tr>--}}
                <tr>
                    <th>OrderID</th>
                    <th>Destination</th>
                    <th>Weight</th>
                    <th>User's name</th>
                    <th>User's contact</th>
                @if($orderDispatcher->status == 'Pending')
                    <th>Accept</th>               
                    <th>Decline</th>
                @elseif($orderDispatcher->status == 'Accepted')
                    <th>Delivered</th>
                @endif
            @elseif($orderDispatcher->status == 'Declined')
                    <th></th>
            @endif
                </tr>
            </thead>
            <tbody>
                @if($orderDispatcher->status == 'Pending' || $orderDispatcher->status == 'Accepted')
                {{--<tr></tr>--}}
                <tr>
                    <td>{{ $orderDispatcher->orders->orderID }}</td>
                    <td>{{ $orderDispatcher->orders->destination }}</td>
                    <td>{{ $orderDispatcher->orders->weight }}</td>
                    <td>{{ $orderDispatcher->users->name }}</td>
                    <td>{{ $orderDispatcher->users->phone }}</td>
                    @if($orderDispatcher->status == 'Pending')
                        <td>
                            <a href="{{ route('notification.accept', $orderDispatcher->orders->id) }}">Accept</a>
                        </td>
                        <td>
                        <button><a href="/notification/decline/{{ $orderDispatcher->orders->id }}/{{ $orderDispatcher->dispatchers->id }}/{{ $orderDispatcher->users->id }}">Decline</a></button>
                        </td>
                    @elseif($orderDispatcher->status == 'Accepted')
                        <button><a href="/notification/delivered/{{ $orderDispatcher->orders->id }}/{{ $orderDispatcher->dispatchers->id }}">Delivered</a></button>
                    @endif
                @elseif($orderDispatcher->status == 'Declined')
                    <td>You do not have any order</td>
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