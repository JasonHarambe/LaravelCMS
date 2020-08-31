@extends('layouts.app')

@section('content')
<div class="col-md-6">
    @if(session('message'))
        <div class="alert alert-success my-4" role="alert">
            {{session('message')}}
        </div>
    @endif
    <div class="card m-5 p-2">
        <div class="card-header bg-white">
            <div class="row mx-1 justify-content-between">
                <h4>Edit Client Detail</h4>
                <form action="{{ route('clients.delete', $client->id) }}" method="POST" class="ml-auto mr-3">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
            <h5 class="bg-warning">Previous Client Detail</h5>
            <p><span class="bg-info">Client ID: </span>&nbsp; {{$client->id}}</p>
            <p><span class="bg-info">Company Name: </span> &nbsp;{{$client->company_name}}</p>
            <p><span class="bg-info">Address: </span> &nbsp;{{$client->company_address}}</p>
            <p><span class="bg-info">Contact: </span> &nbsp;{{$client->company_contact}}</p>
            <p><span class="bg-info">Registration No: </span> &nbsp;{{$client->company_reg}}</p>
            <p><span class="bg-info">Created: </span> &nbsp;{{$client->created_at}}</p>
            <p><span @if($client->created_at != $client->updated_at) class="bg-success" @else class="bg-info" @endif>Updated: </span> &nbsp;{{$client->updated_at}}</p>
        </div>
        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="formGroupExampleInput2">Company Name</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" name="company_name" value="{{$client->company_name}}">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Address</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" name="company_address" value="{{$client->company_address}}">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Contact Number</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" name="company_contact" value="{{$client->company_contact}}">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Registration Number</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" name="company_reg" value="{{$client->company_reg}}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection