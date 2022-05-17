@extends('layouts.admin.main')

@section('content')
<form class="m-3" method="POST">
    @csrf
    <h3 class="alert alert-success">ADD BRAND</h3>
    <div class="mb-3">
        <input type="hidden" name="_method" value="PUT">
        <label for="brand_name" class="form-label">Brand name</label>
        <input type="text" class="form-control @error('brand_name') is-invalid @enderror" value="{{$brand->brand_name}}" id="brand_name" name="brand_name" >
        @error('brand_name')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="http://127.0.0.1:8000/admin/brands" class="btn btn-success">BACK</a>
</form>
@endsection