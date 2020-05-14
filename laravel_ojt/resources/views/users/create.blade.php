@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-md-8 offset-md-2">
        <div class="card-header">
            <h3>Create User</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('users.confirm') }}" enctype="multipart/form-data" method = "POST">
                @csrf
                <div class="form-group input-group">
                    <label class="col-sm-3">Name </label>
                    <input type="text" name="name" class="form-control col-sm-6" value="{{ session('name') }}">
                    @error('name')
                        <p class="text-danger">&nbsp;*{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-3">Email Address </label>
                    <input type="email" name="email" class="form-control col-sm-6" value="{{ session('email') }}">
                    @error('email')
                        <p class="text-danger">&nbsp;*{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-3">Password</label>
                    <input type="password" name="password" class="form-control col-sm-6" value="{{ session('password') }}">
                    @error('password')
                        <p class="text-danger">&nbsp;*{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-3">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control col-sm-6" value="{{ session('password_confirmation') }}">
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-3">Type</label>
                    <select name="type" class="form-control col-sm-6">
                        <option></option>
                        <option value="1" {{ session( 'type' ) == config('constants.admin') ? 'selected' : ''  }}>Admin</option>
                        <option value="2" {{ session( 'type' ) == config('constants.user') ? 'selected' : ''  }}>User</option>
                    </select>
                    @error('type')
                        <p class="text-danger">&nbsp;*{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-3">Phone</label>
                    <input type="number" name="ph" class="form-control col-sm-6" value="{{ session('ph') }}">
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-3">Date of birth </label>
                    <input class="datepicker col-sm-6" type = "date" name="dob" value="{{ session('dob') }}"></textarea>
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-3">Address</label>
                    <textarea name="address" class="form-control col-sm-6" rows="5" cols="20"> {{ session('address') }}</textarea>
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-3">Profile Image</label>
                </div>
                <div class="form-group offset-sm-3">
                    <img  id="target" width="100" style="display:none;"/>
                    <input type="file" id="image" name="image"/>
                </div>
                
                <button type="submit" name="action" value="create" class="btn btn-primary offset-md-2">Confirm</button>
                <button type="reset" class="btn btn-default" onClick="ResetImage();">Clear</button>
            </form>
        </div>
    </div>
</div>
@endsection
