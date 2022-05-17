@extends('layouts.admin.main')

@section('title')
BRAND
@endsection

@section('content')
<table class="table text-center m-3">
    <thead>
        <th>#</th>
        <th>Brand name</th>
        <th><a href="http://127.0.0.1:8000/admin/brands/create"><button class="btn btn-primary">ADD BRAND</button></a></th>
    </thead>
    <tbody>
        @foreach($brands as $b)
        <tr>
            <td>{{$b->id}}</td>
            <td>{{$b->brand_name}}</td>
            <td style="display: flex;justify-content: center;">
                <a href="http://127.0.0.1:8000/admin/brands/{{$b->id}}/edit"><button class="btn btn-warning">UPDATE</button></a>
                <form action="http://127.0.0.1:8000/admin/brands/{{$b->id}}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa thương hiệu này')">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger" type="submit">DELETE</button>
                </form>
            </td>
            <td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection