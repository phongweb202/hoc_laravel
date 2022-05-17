@extends('layouts.admin.main')
@section('content')
<form class="m-3" method="POST" action="">
    @csrf
    <input type="hidden" value="PUT" name="_method">
    <h3 class="alert alert-success">UPDATE COLOR</h3>
    <div class="mb-3">
        <label for="color_name" class="form-label">Color name</label>
        <input type="text" class="form-control @error('color_name') is-invalid @enderror" value="{{$color->color_name}}" id="color_name" name="color_name">

    </div>
    @error('color_name')
    <p class="text-danger">{{$message}}</p>
    @enderror
    <div class="mb-3">
        <label for="color" class="form-label">Color code</label>
        <input type="text" class="form-control @error('color') is-invalid @enderror" value="{{$color->color}}" id="color" name="color">
    </div>
    @error('color')
    <p class="text-danger">{{$message}}</p>
    @enderror
    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-success" href="http://127.0.0.1:8000/admin/colors">BACK</a>
</form>
@endsection