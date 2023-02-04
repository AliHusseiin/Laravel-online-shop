@extends('layouts.main')
@section('content')
    <!-- Main content -->
    <h2>Edit Product</h2>
    <form method="POST" action="{{ url('admin/products/' . $products->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label>Product Name</label>
        <div class="col-4">
            <input class="form-control" name="name" value="{{ old('name') }}" />
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label>Product Image</label>
            <input name="image" type="file" value="{{ old('image') }}" /><br />
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <select class="form-control" name="category_id">
                <option>Category Name</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"{{ old('category_id') == $category['id'] ? 'Selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
            <div>
                <label>Description</label>
                <input class="form-control" type="text" name="description" value="{{ old('description') }}">
            </div>
            <div>
                <label>Price</label>
                <input class="form-control" name="price" type="number" value="{{ old('price') }}" />
            </div>
            <div>
                <label>Discount</label>
                <input class="form-control" name="discount" type="number" value="{{ old('discount') }}" step="0.01" />
            </div>
            <div class="form-group form-check form-group col-6">
                <label>Featured</label>
                <input type="checkbox" name='is_featured'{{ old('is_featured') ? 'checked' : '' }}>
                <label>Recent</label>
                <input type="checkbox" name='is_recent'{{ old('is_recent') ? 'checked' : '' }}>
            </div>
            <select class="form-control" name="size_id">
                <option>Size</option>
                @foreach ($sizes as $size)
                    <option value="{{ $size->id }}"{{ old('size_id') == $size['id'] ? 'Selected' : '' }}>
                        {{ $size->name }}</option>
                @endforeach
            </select>
            <select class="form-control" name="color_id">
                <option>Color</option>
                @foreach ($colors as $color)
                    <option value="{{ $color->id }}"{{ old('color_id') == $color['id'] ? 'Selected' : '' }}>
                        {{ $color->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-success">Edit</button>
            <a class="btn btn-secondary" href="{{ url('admin/products') }}">Cancel</a>
        </div>
    </form>
    <!-- /.content -->
@endsection
