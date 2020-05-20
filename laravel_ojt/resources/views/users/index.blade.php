@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ route('users.index')}}" method="get">
    @csrf
    <div class="form-group row">
        <input type="text" class="form-control col-sm-2 mx-sm-2" name="nameSearch" placeholder="Name">
        <input type="text" class="form-control col-sm-2 mx-sm-2" name="emailSearch" placeholder="Email">
        <input type="date" class="form-control col-sm-2 mx-sm-2" name="createdFromsearch" placeholder="Created From">
        <input type="date" class="form-control col-sm-2 mx-sm-2" name="createdTosearch" placeholder="Created To">
        <input class="btn btn-primary mx-sm-2" type="submit" value="Search">
</form>
        <a href="{{ url('users/create') }}" class="btn btn-primary mx-sm-2">Add</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created User</th>
                <th scope="col">Phone</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Address</th>
                <th scope="col">Created Date</th>
                <th scope="col">Updated Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($userList as $user)
                <tr>
                    <td><a href data-toggle="modal" data-target="#yourModal{{$user->id}}">{{$user->name}}</a>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->c_name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ date('d/m/Y', strtotime($user->dob)) }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>{{ $user->updated_at->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
            @foreach($userList as $user)   
                <div class="modal fade" id="yourModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header" style="background:skyblue;">
                        <h5>User Detail Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/' . $user->profile) }}" class="img-thumbnail offset-md-5" width="100" />
                        <table class="offset-md-3">
                            <tbody>
                                <tr>
                                    <td><span class="col-sm-8">Name</span></td>
                                    <td><span class="col-sm-3">{{$user->name}}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="col-sm-8">Email</span></td>
                                    <td><span class="col-sm-3">{{$user->email}}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="col-sm-6">Type</span></td>
                                    <td><span class="col-sm-6">{{ $user->type == config('constants.admin') ? 'Admin' : 'User' }}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="col-sm-6">Phone</span></td>
                                    <td><span class="col-sm-6">{{ $user->phone }}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="col-sm-8">Birth Date</span></td>
                                    <td><span class="col-sm-3">{{ date('d/m/Y', strtotime($user->dob)) }}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="col-sm-8">Address</span></td>
                                    <td><span class="col-sm-3">{{$user->address}}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="col-sm-6">Create User</span></td>
                                    <td><span class="col-sm-6">{{ $user->c_name }}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="col-sm-6">Created Date</span></td>
                                    <td><span class="col-sm-6">{{ $user->created_at->format('d/m/Y') }}</span></td>
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
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
        {{ $userList->appends(['nameSearch' => request()->nameSearch, 'emailSearch' => request()->emailSearch, 'createdFromsearch' => request()->createdFromsearch, 'createdTosearch' => request()->createdTosearch])->links() }}
        </div>
    </div>
</div>
@endsection
