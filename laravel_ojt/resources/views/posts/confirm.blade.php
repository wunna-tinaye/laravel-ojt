@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-md-8 offset-md-2">
        <div class="card-header">
            <h3>Confirm Post</h3>
        </div>
    <div class="card-body">
        @if($request->action == "create")
            <form action="{{ route('posts.store') }}" method = "POST">
        @elseif($request->action == "edit")
            <form action="{{  url('/posts/' . $post->id ) }}" method = "post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" class="form-control col-sm-6" value="{{$post->id}}">
                <input type="hidden" name="status" class="form-control col-sm-6" value="{{$request->status}}">
        @endif

                @csrf
                <div class="form-group input-group">
                    <label class="col-sm-2">Title </label>
                    <label class="col-sm-8">{{$request->title}} </label>
                    <input type="hidden" name="title" class="form-control col-sm-6" value="{{$request->title}}">
                </div>

                <div class="form-group input-group">
                    <label class="col-sm-2">Description </label>
                    <label class="col-sm-8">{{$request->description}}</label>
                    <input type="hidden" name="description" class="form-control col-sm-6" value="{{$request->description}}">
                </div>

                @if(($request->action == "edit"))
                <div class="form-group input-group">
                    <label  class="col-sm-2"> Status </label>
                    <label class="switch">
                        <input type="checkbox" {{$request->status ? 'checked' : 'unchecked'}} disabled>
                        <span class="slider round"></span>
                    </label>
                </div>
                @endif

                <button class="btn btn-primary offset-md-2" type="submit">Confirm</button>
                <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a> 
            </form>
        </div>
    </div>
</div>
@endsection