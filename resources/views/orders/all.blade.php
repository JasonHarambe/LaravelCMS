@extends('layouts.app')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>All Orders</h1>
    </div>
        <div class="row mx-2">
            <h2>Latest Orders</h2>
            <a href="{{route('orders.create')}}" class="my-2 mx-3">Create Orders</a>
        </div>
    <div class="table-responsive">
        <table class="table table-striped m-2 px-2 table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>@sortablelink('product_name', 'Product')</th>
                <th>Client Name / ID</th>
                <th>@sortablelink('product_unit_price', 'Price')</th>
                <th>@sortablelink('product_amount', 'Amount')</th>
                <th>Total</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach($orders as $order)
        <!-- Orders -->
        <tbody @if($order->trashed()) class="bg-secondary" @endif>
            <tr>
            <td>{{ $order->id }}</td>
            <td>{{$order->product_name}}</td>
            <td @if(empty($order->client->company_name)) class="bg-secondary" @endif>
                <a href="{{route('clients.edit', $order->client_id)}}">
                {{ $order->client->company_name ?? 'CLIENT DELETED'}} 
                </a> &nbsp;&nbsp; 
                @if($order->trashed())
                    <span class="badge badge-danger">{{$order->client_id}}</span>
                @else
                    <span class="badge badge-success">{{$order->client_id}}</span>
                @endif
            </td>
            <td>{{$order->product_unit_price}}</td>
            <td>{{$order->product_amount}}</td>
            <td @if($order->trashed()) class="bg-secondary" @else class="bg-warning" @endif>{{number_format($order->product_amount * $order->product_unit_price, 2)}}</td>
            <td>{{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y  H:i')}}</td>
            @if($order->trashed())
            <td>
                <form action="{{ route('orders.restore', $order->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-warning">Retrieve</button>
                </form>
            </td>
            @else
                <td><a href="{{route('orders.edit', $order->id)}}">view</a></td>
            @endif
            
            </tr>
        </tbody>
        @endforeach
        </table>
        @if ($orders->hasPages())
            {{$orders->appends(\Request::except('page'))->render()}}
        @endif
    </div>
</main>
@endsection