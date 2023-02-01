<!-- Main content -->
@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-success" href="{{ url('admin/products/create') }}">Add</a>
                <table class="table table-bordered table-striped text-center ">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>category</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th scope>Description</th>
                            <th scope>Recent</th>
                            <th scope>Featured</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td> {{ $product['id'] }} </td>
                                <td>{{ $product['name'] }} </td>
                                <td><img src="{{ asset('storage/' . $product['image']) }}" height="150" width="150px" />
                                </td>
                                <td> {{ $product['category']['name'] }} </td>
                                <td> {{ $product['price'] }}</td>
                                <td>{{ $product['discount'] * 100 }} %</td>
                                <td> {{ $product['description'] }} </td>
                                <td> {{ $product['is_recent'] ? 'yes' : 'no' }} </td>
                                <td> {{ $product['is_featured'] ? 'yes' : 'no' }}</td>
                                <td scope="col">
                                    <form action="{{ url('admin/products/' . $product['id']) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Are You Sure?')"
                                            class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                                <td scope="col"><button class="btn btn-success"><a
                                            href="{{ url('admin/products/' . $product['id'] . '/edit') }}">
                                            EDIT</a></button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {!! $products->links() !!}
            </div>
        </div>
    </div>
@endsection
