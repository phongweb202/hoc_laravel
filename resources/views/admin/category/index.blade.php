@extends('layouts.admin.main')

@section('title')
CATEGORY
@endsection

@section('content')
<div class="m-3 bg-light">
  <table class="table text-center">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Category Name</th>
        <th ><a href="http://127.0.0.1:8000/admin/category/create"><button class="btn btn-primary">ADD CATEGORY</button></a></th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $c)
      <tr>
        <th scope="row">{{$c->id}}</th>
        <td>{{$c->name}}</td>
        <td style="display: flex;justify-content: center;">
                <a href="http://127.0.0.1:8000/admin/category/{{$c->id}}/edit"><button class="btn btn-warning">UPDATE</button></a>
                <form action="http://127.0.0.1:8000/admin/category/{{$c->id}}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa danh mục  này')">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger" type="submit">DELETE</button>
                </form>
            </td>
      </tr>
      @endforeach


    </tbody>
  </table>
</div>
@endsection