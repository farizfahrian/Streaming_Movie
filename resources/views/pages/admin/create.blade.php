@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-5 mt-5">Dashboard Admin</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action=" {{ route('admin.store') }} " method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea id="description" name="description" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration (minutes):</label>
                        <input type="number" id="duration" name="duration" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating:</label>
                        <input type="number" id="rating" name="rating" step="0.1" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="image_link" class="form-label">Image Link:</label>
                        <input type="url" id="image_link" name="image_link" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="video_link" class="form-label">Video Link:</label>
                        <input type="url" id="video_link" name="video_link" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="genre" class="form-label">Genre:</label>
                        <input type="text" id="genre" name="genre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="release_date" class="form-label">Release Date:</label>
                        <input type="date" id="release_date" name="release_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <hr>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
@endsection