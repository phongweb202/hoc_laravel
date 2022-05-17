@extends('layouts.admin.main')

@section('content')

<form class="m-3" method="POST" action="">
    @csrf

    <h3 class="alert alert-success">UPDATE CATEGORY</h3>
    <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$category->name}}">
        <input type="hidden" name="_method" value="PUT">
        @error('name')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-success" href="http://127.0.0.1:8000/admin/category">BACK</a>
</form>


@endsection
