@extends('layouts.admin.admin')

@section('content')

@if(Session::has('create_user'))
<p class="alert alert-success">{{session('create_user')}}</p>
@endif

@if(Session::has('deleted_use'))
<p class="bg-danger">{{session('deleted_user') }}</p>
@endif

@if(Session::has('update_user'))
<p class="alert alert-success">{{session('update_user') }}</p>
@endif

<h1>Users</h1>

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Avata</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created</th>
            <th>Updated</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>

    <tbody>
        @if($users)
        @foreach ($users as $user) 
        <tr>
            <td>{{$user->id}}</td>
            <td><img height="50" width="50" src="{{$user->user_avata()? asset( $user->user_avata()->folder.$user->user_avata()->attached_file): 'http://placehold.it/400x400'}}" alt="image"></td>
            <td>{{$user->username}}</td>
            <td>{{$user->email}}</td>
            <td>
                @if(($user->role) == 0)
                    Client
                @else
                    Admin
                @endif
            </td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
            <td><a href="{{route('admin.users.edit',$user->id) }}" >Edit</a></td>
            <td>
                <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                        {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form> 
            </td>
        </tr>
        @endforeach
        @endif

    </tbody>
</table>

<div class="row">
    <div class="col-lg-6 col-sm-offset-5">
        {{$users->render()}}
    </div>
</div>
@stop


