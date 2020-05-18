@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="card col-md-7 offset-md-2">
        <div class="card-header">
            <h3>Change Password</h3>
        </div>
        <div class="card-body">
            <form action="{{  url('/users/' . $user->id .'/changePassword' ) }}" method = "post">
                @csrf
                <div class="form-group input-group">
                    <label class="col-sm-5">Old Password</label>
                    <input type="password" name="old_password" class="form-control col-sm-6">
                    @error('old_password')
                        <p class="text-danger">&nbsp;*{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-5">New Password</label>
                    <input type="password" name="password" class="form-control col-sm-6" >
                    @error('password')
                        <p class="text-danger">&nbsp;*{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-5">Confirmed New Password</label>
                    <input type="password" name="password_confirmation" class="form-control col-sm-6">
                    @error('password_confirmation')
                        <p class="text-danger">&nbsp;*{{ $message }}</p>
                    @enderror
                </div>

                <button class="btn btn-primary offset-sm-3" type="submit">Change</button>
                <button class="btn btn-default" type="reset">Clear</button>
            </form>
        </div>
    </div>
</div>
@endsection