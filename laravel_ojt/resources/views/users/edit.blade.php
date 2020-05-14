@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-md-6 offset-md-3">
        <div class="card-header">
            <h3>Update User</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('users.updateConfirm', $user->id) }}" enctype="multipart/form-data" method = "POST">
                @csrf
                <div class="form-group input-group">
                    <label class="col-sm-4">Name </label>
                    @if(session()->has('name'))
                        <input type="text" name="name" class="form-control col-sm-6" value="{{ session('name') }}">
                    @else
                        <input type="text" name="name" class="form-control col-sm-6" value="{{ $user->name }}">
                    @endif
                    @error('name')
                        <p class="text-danger">&nbsp;*{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-4">Email Address </label>
                    @if(session()->has('email'))
                        <input type="email" name="email" class="form-control col-sm-6" value="{{ session('email') }}">
                    @else
                        <input type="email" name="email" class="form-control col-sm-6" value="{{ $user->email }}">
                    @endif
                    @error('email')
                        <p class="text-danger">&nbsp;*{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-4">Type</label>
                    <select name="type" class="form-control col-sm-6">
                        <option></option>
                        @if(session()->has('type'))
                            <option value="1" {{ session( 'type' ) == config('constants.admin') ? 'selected' : ''  }}>Admin</option>
                            <option value="2" {{ session( 'type' ) == config('constants.user') ? 'selected' : ''  }}>User</option>
                        @else
                            <option value="1" {{ $user->type == config('constants.admin') ? 'selected' : ''  }}>Admin</option>
                            <option value="2" {{ $user->type == config('constants.user') ? 'selected' : ''  }}>User</option>
                        @endif
                    </select>
                    @error('type')
                        <p class="text-danger">&nbsp;*{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-4">Phone</label>
                    @if(session()->has('ph'))
                        <input type="number" name="ph" class="form-control col-sm-6" value="{{ session('ph') }}">
                    @else
                        <input type="number" name="ph" class="form-control col-sm-6" value="{{ $user->phone }}">
                    @endif
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-4">Date of birth </label>
                    @if(session()->has('dob'))
                        <input type = "date" name="dob" value="{{ session('dob') }}">
                    @else
                        <input type = "date" name="dob" value="{{ $user->dob }}">
                    @endif
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-4">Address</label>
                    @if(session()->has('address'))
                        <textarea name="address" class="form-control col-sm-6" rows="5" cols="20"> {{ session('address') }}</textarea>
                    @else
                        <textarea name="address" class="form-control col-sm-6" rows="5" cols="20"> {{ $user->address }}</textarea>
                    @endif
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-4">Profile Image</label>
                    <input type="file" id="image" name="image" />
                </div>

                <div class="form-group">
                    <img class="offset-sm-4" id="target" width="100" style="display:none;"/>
                </div>

                <div class="form-group input-group">
                    <a href="#" class="col-sm-4">Change Password</a>
                </div>
                <button type="submit" name="action" value="edit" class="btn btn-primary">Confirm</button>
                <button type="reset" class="btn btn-default">Clear</button>
            </form>
        </div>
    </div> 
</div>
@endsection