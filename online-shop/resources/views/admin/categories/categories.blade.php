@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-success" href="{{ url('admin/addCategory') }}">Add</a>
                <table class="table table-bordered table-striped text-center ">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td> {{ $category['id'] }} </td>
                                <td>{{ $category['name'] }} </td>
                                <td><img src="{{ asset('storage/' . $category['image']) }}" height="150" width="150px" />
                                </td>
                                <td scope="col">
                                    <form action="{{ url('admin/' . $category['id']) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Are You Sure?')"
                                            class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                                <td scope="col"><button class="btn btn-success"><a
                                            href="{{ url('admin/' . $category['id'] . '/edit') }}">
                                            EDIT</a></button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {!! $categories->links() !!}
            </div>
        </div>
    </div>
@endsection
