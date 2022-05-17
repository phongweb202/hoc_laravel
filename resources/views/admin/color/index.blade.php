@extends('layouts.admin.main')

@section('title')
COLOR
@endsection

@section('content')
<table class="table text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>Color Name</th>
            <th>Color</th>
            <th><a href="http://127.0.0.1:8000/admin/colors/create"><button class="btn btn-primary">ADD COLOR</button></a></th>
        </tr>
    </thead>
    <tbody>
        @foreach($colors as $c)
        <tr>
            <td>{{$c->id}}</td>
            <td>{{$c->color_name}}</td>
            <td>{{$c->color}}</td>
            <td style="display: flex;justify-content: center;">
                <a href="http://127.0.0.1:8000/admin/colors/{{$c->id}}/edit"><button class="btn btn-warning">UPDATE</button></a>
                <form action="http://127.0.0.1:8000/admin/colors/{{$c->id}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">DELETE</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection