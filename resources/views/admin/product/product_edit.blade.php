@extends('layouts.admin.main')
@section('content')

@section('title')
PRODUCT
@endsection

<form class="m-3" method="POST" action="" enctype="multipart/form-data">

    @csrf
    <input type="hidden" name="_method" value="PUT">
    <h3 class="alert alert-success">ADD PRODUCT</h3>
    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}" id="name" name="name">
                @error('name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}" id="price" name="price">
                @error('price')
                <p class="text-danger">{{$message}}</p>
                @enderror

            </div>
        </div>


    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <label for="sale" class="form-label">Sale</label>
                <input type="number" class="form-control" value="{{$product->sale}}" id="sale" name="sale">
                @error('name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" value="{{$product->quantity}}" id="quantity" name="quantity">
                @error('quantity')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>

    </div>


    <div class="mb-3">
        <label for="img" class="form-label">Image</label>
        <input type="file" class="form-control" id="img" name="img">
        <img src="{{asset('storage/images/'.$product->img.'')}}" alt="">
    </div>


    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id">
                    @foreach($categories as $c)
                    <option value="{{$c->id}}" {{$product->category_id == $c->id ? 'selected' : ''}}>{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label for="brand_id" class="form-label">Brand</label>
                <select class="form-select" id="brand_id" name="brand_id">
                    @foreach($brands as $b)
                    <option value="{{$b->id}}" {{$product->brand_id == $b->id ? 'selected' : ''}}>{{$b->brand_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>


    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <span class="form-control">
            <div class="form-check form-check-inline mt-1">
                <input class="form-check-input" type="radio" name="status" id="status" value="0" {{$product->status == 0 ? 'checked' : ''}}>
                <label class="form-check-label" for="status">
                    stocking
                </label>
            </div>
            <div class="form-check form-check-inline mt-1">
                <input class="form-check-input" type="radio" name="status" id="status" value="1" {{$product->status == 1 ? 'checked' : ''}}>
                <label class="form-check-label" for="status">
                    Out of stock
                </label>
            </div>
        </span>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Color</label>
        <span class="form-control">
            @foreach($colors as $c)
            <div class="form-check form-check-inline mt-1">
                <input class="form-check-input" {{$check($c,$product_colors) ? 'checked' : ''}} type="checkbox" name="color{{$loop->index}}" id="color" value="{{$c->id}}">
                <label class="form-check-label" for="color">{{$c->color_name}}</label>
            </div>
            @endforeach
        </span>

    </div>
    <div class="mb-3">
        <label for="short_desc" class="form-label">Short desc</label>
        <textarea class="form-control" name="short_desc" id="short_desc" rows="3">{{$product->shorth_desc}}</textarea>
    </div>
    <div class="mb-3">
        <label for="describe_specific" class="form-label">Describe specific</label>
        <textarea id="describe_specific" name="describe_specific">
        {{$product->describe_specific}}
        </textarea>
    </div>
    <div class="mb-3 col-12">
        <div class="row">
            <div class="col-6">
                <label for="width" class="form-label">Width</label>
                <input type="number" class="form-control" id="width" name="width" value="{{$product->infomation->width}}">
            </div>
            <div class="col-6">
                <label for="height" class="form-label">Height</label>
                <input type="number" class="form-control" id="height" name="height" value="{{$product->infomation->height}}">
            </div>
        </div>
    </div>

    <div class="mb-3 col-12">
        <div class="row">
            <div class="col-6">
                <label for="depth" class="form-label">Depth</label>
                <input type="number" class="form-control" id="depth" name="depth" value="{{$product->infomation->depth}}">
            </div>
            <div class="col-6">
                <label for="quality_checking" class="form-label">Quanlity checking</label>
                <span class="form-control">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="quality_checking" id="quality_checking" value="0" {{$product->infomation->quality_checking == 0 ? 'checked' : ''}}>
                        <label class="form-check-label" for="quality_checking">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="quality_checking" id="quality_checking" value="1" {{$product->infomation->quality_checking == 1 ? 'checked' : ''}}>
                        <label class="form-check-label" for="quality_checking">No</label>
                    </div>
                </span>
            </div>
        </div>
    </div>

    <div class="mb-3 col-12">
        <label for="freshness_duration" class="form-label">Freshness Duration</label>
        <input type="number" class="form-control" id="freshness_duration" name="freshness_duration" value="{{$product->infomation->freshness_duration}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-success" href="http://127.0.0.1:8000/admin/colors">BACK</a>
</form>

<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#describe_specific'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection