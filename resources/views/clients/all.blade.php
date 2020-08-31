@extends('layouts.app')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>All Clients</h1>
    </div>
        <div class="row mx-2">
            <h2>Latest Clients</h2>
            <a href="{{route('clients.create')}}" class="my-2 mx-3">Create Clients</a>
        </div>
    <div class="table-responsive">
        <table class="table table-striped m-2 px-2 table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>@sortablelink('company_name', 'Company')</th>
                <th>@sortablelink('company_address', 'Address')</th>
                <th>@sortablelink('company_reg', 'Registration ID')</th>
                <th>@sortablelink('company_contact', 'Contact No')</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach($clients as $client)
            <tbody>
                <tr>
                <td>{{ $client->id }}</td>
                <td>{{$client->company_name}}</td>
                <td>{{$client->company_address}}</td>
                <td>{{$client->company_reg}}</td>
                <td>{{$client->company_contact}}</td>
                <td>{{\Carbon\Carbon::parse($client->created_at)->format('d/m/Y H:i')}}</td>
                <td><a href="{{route('clients.edit', $client->id)}}">view</a></td>  
                </tr>
            </tbody>
        @endforeach
        </table>
        @if ($clients->hasPages())
            {{$clients->appends(\Request::except('page'))->render()}}
        @endif
    </div>
</main>
@endsection