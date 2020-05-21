@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-md-9 offset-md-2">
        <div class="card-header">
            <h3>Edit Post</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('posts.updateConfirm', $post->id) }}" method = "POST">
                @csrf
        
                <div class="form-group input-group">
                    <label class="col-sm-2">Title </label>
                    @if(session()->has('title'))
                        <input type="text" name="title" class="form-control col-sm-6" value="{{ session('title') }}">
                    @else
                        <input type="text" name="title" class="form-control col-sm-6" value="{{ $post->title }}">
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
                        <textarea name="description" class="form-control col-sm-6" rows="5" cols="20"> {{ $post->description }}</textarea>
                    @endif
                    @error('description')
                        <p class="text-danger">&nbsp;*{{ $message }}</p>
                    @enderror
                </div>
                                
                <div class="form-group input-group">
                    <label class="col-sm-2"> Status </label>
                    @if(session()->has('status'))
                    <label class="switch">
                        <input type="checkbox" name="status" {{session('status') ? 'checked' : ''}}>
                        <span class="slider round"></span>
                    </label>
                    @else
                    <label class="switch">
                        <input type="checkbox" name="status" {{$post->status ? 'checked' : ''}}>
                        <span class="slider round"></span>
                    </label>
                    @endif
                </div>
                <button type="submit" name="action" value="edit" class="btn btn-primary offset-sm-2">Confirm</button>
                <input type="reset" class="btn btn-default" value="Reset">
            </form>
        </div>
    </div>
</div>
@endsection