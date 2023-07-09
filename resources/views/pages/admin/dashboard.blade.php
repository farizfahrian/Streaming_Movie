@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="mb-5 mt-5">Dashboard Admin</h1>
    <a href=" {{ route('admin.create') }} ">Tambah Movie</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Rating</th>
                <th>Genre</th>
                <th>Release</th>
                <td>Show</td>
                <td>Update</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
            <tr>
                <td>{{ $movie->id }}</td>
                <td>{{ $movie->name }}</td>
                <td>{{ $movie->description }}</td>
                <td>{{ $movie->duration }}</td>
                <td>{{ $movie->rating }}</td>
                <td>{{ $movie->genre }}</td>
                <td>{{ $movie->release_date }}</td>
                <td>
                    <a href="{{ route('admin.show', $movie->id) }}" class="btn btn-primary">Show</a>
                </td>
                <td><a href="{{ route('admin.edit', $movie->id) }}" class="btn btn-success">Update</a></td>
                <td>
                    <form action="{{ route('admin.delete', $movie->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- /.container-fluid -->
@endsection