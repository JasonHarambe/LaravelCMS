@extends('layouts.app')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>CMS Users</h1>
    </div>
        <div class="row mx-2">
            <h2>Latest CMS Users</h2>
            <a href="{{route('users.create')}}" class="my-2 mx-3">Create User</a>
        </div>
    <div class="table-responsive">
        <table class="table table-striped m-2 px-2 table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>@sortablelink('name', 'Name')</th>
                <th>@sortablelink('email', 'Email')</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach($users as $user)
            <tbody @if ($user->blocked_at) class="bg-secondary" @endif>
                <tr>
                <td>{{ $user->id }}</td>
                <td>{{$user->name}} @if ($user->hasRole('admin'))&nbsp;&nbsp; <span class="badge badge-danger">admin</span> @endif</td>
                <td>{{$user->email}}</td>
                <td>{{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i')}}</td>
                @if ($user->blocked_at)
                <td>
                <form action="{{ route('users.unblock', $user->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-warning">Retrieve</button>
                </form>
                </td>
                @else
                <td><a href="{{route('users.edit', $user->id)}}">view</a></td>
                @endif
                </tr>
            </tbody>
        @endforeach
        </table>
        @if ($users->hasPages())
            {{$users->appends(\Request::except('page'))->render()}}
        @endif
    </div>
</main>
@endsection