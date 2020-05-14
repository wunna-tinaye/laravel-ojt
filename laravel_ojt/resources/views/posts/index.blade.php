@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-danger" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('posts.index')}}" method="get">
        @csrf
        <div class="form-group row">
            <input type="text" class="form-control col-sm-2" name="search">
            <input class="btn btn-primary mx-sm-2" type="submit" value="Search">
    </form>
            <a href="{{ url('posts/create') }}" class="btn btn-primary mx-sm-2">Add</a>
            <a href="{{ url('upload') }}" class="btn btn-primary mx-sm-2">Upload</a>
            <a href="{{ route('export') }}" class="btn btn-primary mx-sm-2">Download</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Post Title</th>
                <th scope="col">Post Description</th>
                <th scope="col" style="width:10%">Post User</th>
                <th scope="col">Post Date</th>
                <th scope="col"></th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($postList as $post)
                <tr>
                    <td><a href data-toggle="modal" data-target="#yourModal{{$post->id}}">{{$post->title}}</a>
                    <td style="word-break: break-all;">{{ $post->description }}</td>
                    <td>{{ $post->c_name }}</td>
                    <td>{{ $post->created_at->format('d/m/Y') }}</td>
                    <td><a href="{{ url('/posts/' . $post->id . '/edit') }}">Edit</a></td>      
                    <td>
                        <form action="{{ route('posts.destroy', $post->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @foreach($postList as $post)   
        <div class="modal fade" id="yourModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header" style="background:skyblue;">
                <h5>Post Detail Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table>
                    <tbody>
                        <tr>
                            <td><span class="col-sm-8">Title</span></td>
                            <td><span class="col-sm-3">{{$post->title}}</span></td>
                        </tr>
                        <tr>
                            <td><span class="col-sm-8">Description</span></td>
                            <td><span class="col-sm-3">{{$post->description}}</span></td>
                        </tr>
                        <tr>
                            <td><span class="col-sm-8">Status</span></td>
                            <td><span class="col-sm-3">{{$post->status}}</span></td>
                        </tr>
                        <tr>
                            <td><span class="col-sm-6">Post Created User</span></td>
                            <td><span class="col-sm-6">{{ $post->c_name }}</span></td>
                        </tr>
                        <tr>
                            <td><span class="col-sm-6">Posted Date</span></td>
                            <td><span class="col-sm-6">{{$post->created_at}}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $postList->appends(['search' => request()->search])->links() }}
        </div>
    </div>    
</div>
@endsection