@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-md-9 offset-md-2">
        <div class="card-header">
            <h3>Create Post</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('posts.confirm') }}" method = "POST">
                @csrf
                <div class="form-group input-group">
                    <label class="col-sm-2">Title </label>
                    @if(session()->has('title'))
                    <input type="text" name="title" class="form-control col-sm-6" value="{{ session('title') }}">
                    @else
                    <input type="text" name="title" class="form-control col-sm-6" value="{{ old('title') }}">
                    @endif
                    @error('title')
                        <p class="text-danger">&nbsp;*{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-2">Description </label>
                    @if(session()->has('description'))
                    <textarea name="description" class="form-control col-sm-6" rows="5" cols="20"> {{ session('description') }}</textarea>
                    @else
                        <textarea name="description" class="form-control col-sm-6" rows="5" cols="20"> {{ old('description') }}</textarea>
                    @endif
                    @error('description')
                        <p class="text-danger">&nbsp;*{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" name="action" value="create" class="btn btn-primary offset-sm-2">Confirm</button>
                <button type="reset" class="btn btn-default">Clear</button>
            </form>
        </div>
    </div>
</div>
@endsection