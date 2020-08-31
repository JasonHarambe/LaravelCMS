@extends('layouts.app')

@section('content')
<div class="col-md-10">
    @if(session('message'))
        <div class="alert alert-success my-4" role="alert">
            {{session('message')}}
        </div>
    @endif
    <div class="card m-5 p-2">
    <div class="card-header bg-white">
        <div class="row">
            <h2 class="mx-4">Edit Order Detail</h2>
                <form action="{{ route('orders.delete', $order->id) }}" method="POST" class="ml-auto">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            <a class="btn btn-sm btn-primary mb-3 ml-2" href="{{ route('orders.pdf', $order->id) }}">Export</a>
        </div>
        <h5 class="bg-warning">Previous Order Detail</h5>
        <p><span class="bg-success">Order ID: </span>&nbsp; {{$order->id}}</p>
        <p><span class="bg-success">Client: </span> &nbsp;{{$order->client->company_name ?? 'CLIENT DELETED'}}</p>
        <p><span class="bg-success">Product ID: </span> &nbsp;{{$order->product_id}}</p>
        <p><span class="bg-success">Product Name: </span> &nbsp;{{$order->product_name}}</p>
        <p><span class="bg-success">Product Amount: </span>&nbsp; {{$order->product_amount}}</p>
        <p><span class="bg-success">Price: </span>&nbsp; {{$order->product_unit_price}}</p>
        <p><span class="bg-success">Total: </span>&nbsp; {{number_format($order->product_amount * $order->product_unit_price, 2)}}</p>
        <p><span class="bg-success">Created: </span>&nbsp; {{$order->created_at}}</p>
        <p><span @if($order->created_at != $order->updated_at) class="bg-primary" @else class="bg-success" @endif>Updated: </span>&nbsp; {{$order->updated_at}}</p>
    </div>
    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="exampleFormControlSelect1">Client</label>
            <select class="form-control" id="exampleFormControlSelect1" name="client_company">
                @foreach ($clients as $client)
                    <option @if($order->client_id == $client->id) 
                        selected= "selected" 
                            @endif>{{$client->company_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Product ID</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="product_id" value="{{$order->product_id}}">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Product Name</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="product_name" value="{{$order->product_name}}">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Product Amount</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="product_amount" value="{{$order->product_amount}}">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Price</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="product_unit_price" value="{{$order->product_unit_price}}">
        </div>
    <button type="submit" class="btn btn-primary">Update</button>
    </form>

    </div>
</div>
@endsection