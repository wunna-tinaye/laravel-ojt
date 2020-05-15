@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-md-6 offset-md-3">
        <div class="card-header">
            <h5>User Profile</h5>
        </div>
        <div class="card-body">
            <a class="col-sm-3 offset-sm-6" href="{{ url('/users/' . $user->id . '/edit') }}">Edit</a>
            <div class="form-group input-group">
                <label class="col-sm-4">Profile Image</label>
                <img src="{{ asset('storage/' . $user->profile) }}" class="img-thumbnail" width="75" />
                <input type="hidden" name="image" value="{{$user->image}}"/>
            </div>
            <div class="form-group input-group">
                <label class="col-sm-4">Name </label>
                <label class="col-sm-4">{{ $user->name }} </label>
            </div>

            <div class="form-group input-group">
                <label class="col-sm-4">Email Address </label>
                <label class="col-sm-4"> {{ $user->email }} </label>
            </div>

            <div class="form-group input-group">
                <label class="col-sm-4">Type</label>
                <label class="col-sm-4"> User </label>
            </div>

            <div class="form-group input-group">
                <label class="col-sm-4">Phone</label>
                <label class="col-sm-4"> {{ $user->phone }} </label>
            </div>

            <div class="form-group input-group">
                <label class="col-sm-4">Date of birth </label>
                <label class="col-sm-4"> {{ $user->dob }} </label>
            </div>

            <div class="form-group input-group">
                <label class="col-sm-4">Address</label>
                <label class="col-sm-4"> {{ $user->address }} </label>
            </div>
        </div>
    </div>
</div>
@endsection