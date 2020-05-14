@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            @foreach (session('error') as $err)
                @foreach($err->errors() as $actualerr)
                    <ul>
                        <li>{{ $actualerr }}</li>
                    </ul>
                @endforeach
            @endforeach
        </div>
    @endif
    <h4>Upload CSV File</h4>
    <div class="form group">
        <p class="col-md-3 offset-md-1">Import File From:</p>
    </div>
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="border border-primary rounded col-md-4 offset-md-1">
            <div class="form-group">
                <input type="file" class="btn btn-default offset-md-1" name="file" accept=".csv" id="fileToUpload">
                @error('file')
                        <p class="text-danger">&nbsp;*{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="submit" value="Import File" class="btn btn-primary  offset-md-2" name="submit">
            </div> 
        </div>
    </form>
</div>
@endsection