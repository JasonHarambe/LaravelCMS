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
            <h4>Edit User Detail</h4>
                <div class="row">
                    @if($user->blocked_at)
                        <form action="{{ route('users.unblock', $user->id) }}" method="POST" class="mr-1">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning">Activate</button>
                        </form>
                    @else
                        <form action="{{ route('users.block', $user->id) }}" method="POST" class="mr-1">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Disable</button>
                        </form>
                        @if(Auth::user()->hasRole('admin'))
                            @if($user->hasRole('admin'))
                                <form action="{{ route('users.unmake', $user->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Un-Admin</button>
                                </form>                            
                            @else
                                <form action="{{ route('users.make', $user->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Make Admin</button>
                                </form>
                            @endif
                        @endif
                    @endif
                </div>
        </div>
        @if ($user->blocked_at)
            <h5 class="bg-secondary">Previous User Detail</h5>
            <p class="bg-secondary">User ID: &nbsp; {{$user->id}}</p>
            <p class="bg-secondary">Name: &nbsp;{{$user->name}}</p>
            <p class="bg-secondary">Email: &nbsp;{{$user->email}}</p>
        @else
            <h5 class="bg-warning">Previous Client Detail</h5>
            <p><span class="bg-info">Client ID: </span>&nbsp; {{$user->id}}</p>
            <p><span class="bg-info">Name: </span> &nbsp;{{$user->name}}</p>
            <p><span class="bg-info">Email: </span> &nbsp;{{$user->email}}</p>
            <p><span class="bg-info">Created: </span>&nbsp; {{$user->created_at}}</p>
            <p><span @if($user->created_at != $user->updated_at) class="bg-success" @else class="bg-info" @endif>Updated: </span>&nbsp; {{$user->updated_at}}</p>
        @endif
    </div>
    @if (!$user->blocked_at)
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="formGroupExampleInput2">Name</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="user_name" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Email</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="user_email" value="{{$user->email}}">
        </div>
    <button type="submit" class="btn btn-primary">Update</button>
    </form>
    @endif

    </div>
</div>
@endsection