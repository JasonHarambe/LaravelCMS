@extends('layouts.app')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>Dashboard</h1>
    </div>
    <div class="row mx-2">
        <div class="col-6">
            <!--Client-->
            <div class="row justify-content-between mx-2">
                <h2>Client</h2>
                <span class="h2">{{$clients_count}}</span>
            </div>
            <div class="list-group">
                @foreach($clients as $client)
                    <a href="{{route('clients.edit', $client->id)}}" class="list-group-item list-group-item-action list-group-item-info">
                        {{$client->company_name}}
                        <span class="badge badge-primary">{{$client->company_contact}}</span>
                    </a>
                @endforeach
            </div>
            <span class="m-2">{{$clients->appends(['client' => $clients->currentPage()])->onEachSide(1)->links()}}</span>

            <div class="row justify-content-between mx-2">
                <h2>CMS Users</h2>
                <span class="h2">{{$users_count}}</span>
            </div>

          <!-- Users -->
            <div class="list-group">
                @foreach($users as $user)
                    <a href="{{route('users.edit', $user->id)}}" 
                            @if ($user->hasRole('admin')) 
                        class="list-group-item list-group-item-action list-group-item-success" 
                            @else 
                        class="list-group-item list-group-item-action list-group-item-info" 
                            @endif
                    >{{$user->name}} @if($user->hasRole('admin')) <span class="badge badge-warning">admin</span> @endif</a>
                @endforeach
            <span class="m-2">{{$users->appends(['user' => $users->currentPage()])->onEachSide(1)->links()}}</span>
            </div>
        </div>
        <!-- Orders -->
        <div class="col-6 mb-5">
            <div class="row justify-content-between mx-2">
                <h2>Orders</h2>
                <span class="h2">{{$orders_count}}</span>
            </div>
            <span class="m-2">{{$orders->appends(['order' => $orders->currentPage()])->onEachSide(1)->links()}}</span>
            <div class="list-group">
                @foreach($orders as $order)
                <a href="{{route('orders.edit', $order->id)}}" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{$order->product_name}}</h5>
                    <small>{{\Carbon\Carbon::parse($order->created_at)->diffForHumans()}}</small>
                    </div>
                    <p class="mb-1">
                        Product ID: {{$order->product_id}} <br>
                        Product Name: {{$order->product_name}} <br>
                        Amount: {{$order->product_amount}} <br>
                        Price: {{$order->product_unit_price}} <br>
                        <span class="bg-warning">
                            Total: {{number_format($order->product_amount * $order->product_unit_price, 2)}}
                        </span></p>
                    <small>Client Name: {{$order->client->company_name ?? 'CLIENT DELETED'}}</small>
                </a>
                @endforeach
            </div>
        </div>  
    </div>
</main>
@endsection