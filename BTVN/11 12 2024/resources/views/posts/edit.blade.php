<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand h1 text-light" href="{{ route('posts.index') }}">CRUDPosts</a>
            <div class="justify-content-end">
                <a class="btn btn-sm btn-success" href="{{ route('posts.create') }}">Add Post</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Update Post</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('posts.update', $post->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <!-- Title Input -->
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" 
                                    value="{{ $post->title }}" placeholder="Enter post title" required>
                            </div>
                            <!-- Content Input -->
                            <div class="form-group mb-3">
                                <label for="body" class="form-label">Content</label>
                                <textarea class="form-control" id="body" name="body" rows="5" 
                                    placeholder="Update the content here..." required>{{ $post->content }}</textarea>
                            </div>
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100">Update Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="text-center p-3 bg-primary text-white">
            © 2024 CRUDPosts. All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
