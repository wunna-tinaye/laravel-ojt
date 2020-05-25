@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-md-8 offset-md-2">
        <div class="card-header">
            <h3>Confirm User</h3>
        </div>
        <div class="card-body">
            @if($request->action == "create")
                <form action="{{ route('users.store') }}" enctype="multipart/form-data" method = "POST">
            @elseif($request->action == "edit")
                <form action="{{  url('/users/' . $user->id ) }}" enctype="multipart/form-data" method = "post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" class="form-control col-sm-6" value="{{$user->id}}">
            @endif
                @csrf
                <div class="form-group input-group">
                    <label class="col-sm-4">Name</label>
                    <label class="col-sm-4">{{$request->name}} </label>
                    <input type="hidden" name="name" class="form-control col-sm-6" value="{{$request->name}}">
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-4">Email Address</label>
                    <label class="col-sm-4">{{$request->email}}</label>
                    <input type="hidden" name="email" class="form-control col-sm-6" value="{{$request->email}}">
                </div>

                @if($request->action == "create")
                <div class="form-group input-group">
                    <label class="col-sm-4">Password</label>
                    <input type="password" name="password" readonly  class="form-control-plaintext col-sm-6" id="password_confirm" value="{{$request->password}}">                </div>
                @endif

                <div class="form-group input-group">
                    <label class="col-sm-4">Type</label>
                    @if($request->type == config('constants.admin'))
                        <label class="col-sm-4">Admin</label>
                    @elseif($request->type == config('constants.user'))
                        <label class="col-sm-4">User</label>
                    @endif
                    <input type="hidden" name="type" class="form-control col-sm-6" value="{{$request->type}}">
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-4">Phone</label>
                    <label class="col-sm-4">{{$request->ph}}</label>
                    <input type="hidden" name="ph" class="form-control col-sm-6" value="{{$request->ph}}">
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-4">Date Of Birth</label>
                    <label class="col-sm-4">{{$request->dob}}</label>
                    <input type="hidden" name="dob" class="form-control col-sm-6" value="{{$request->dob}}">
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-4">Address</label>
                    <label class="col-sm-4">{{$request->address}}</label>
                    <input type="hidden" name="address" class="form-control col-sm-6" value="{{$request->address}}">
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-4">Profile Image</label>
                    <img src="{{ asset('storage/' . $request->image) }}" class="img-thumbnail" width="75" />
                    <input type="hidden" name="image" value="{{$request->image}}"/>
                </div>

                <button class="btn btn-primary offset-md-3" type="submit">Confirm</button>
                <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a> 
            </form>
        </div>
    </div>
</div>
@endsection