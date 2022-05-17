@extends('layouts.admin.main')

@section('title')
PRODUCT
@endsection

@section('content')
<table class="table text-center  table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Status</th>
            <th><a href="http://127.0.0.1:8000/admin/products/create"><button class="btn btn-primary">ADD PRODUCT</button></a></th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $p)
        <tr>
            <td>{{$loop->index + 1}}</td>
            <td><img src="{{asset('storage/images/'.$p->img.'')}}" alt="" style="width: 75px;"></td>
            <td>{{$p->name}}</td>
            <td>{{$p->price}}</td>
            <td>{{$p->quantity}}</td>
            <td>{{$p->category->name}}</td>
            <td>{{$p->brand->brand_name}}</td>
            <td>{{$p->status === 0 ? 'stocking' : 'Out of stock'}}</td>
            <td>

                <a href="http://127.0.0.1:8000/admin/products/{{$p->id}}/edit" style="float: left;"><button class="btn btn-warning">UPDATE</button></a>
                <form action="http://127.0.0.1:8000/admin/products/{{$p->id}}" method="POST" style="float: left;" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này')">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger" type="submit">DELETE</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<p class="m-3">{{$products->links()}}</p>

@endsection