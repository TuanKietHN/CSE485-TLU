<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-
alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-
GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous">
    <title>Posts</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand h1 text-light" href="{{ route('posts.index') }}">CRUDPosts</a>
        <div class="justify-content-end">
            <a class="btn btn-sm btn-success" href="{{ route('posts.create') }}">Add Post</a>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <div class="row g-4">
        @foreach ($posts as $post)
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 d-flex flex-column">
                <div class="card-header">
                    <h5 class="card-title">{{ $post->title }}</h5>
                </div>
                <div class="card-body flex-grow-1">
                    <p class="card-text">{{ $post->content }}</p>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<footer class="bg-dark text-white py-3 mt-5">
        <div class="container text-center">
            <p>&copy; 2024 My Blog. All Rights Reserved.</p>
            <p>Follow us on:
                <a href="#" class="text-white text-decoration-none mx-1">Facebook</a> |
                <a href="#" class="text-white text-decoration-none mx-1">Twitter</a> |
                <a href="#" class="text-white text-decoration-none mx-1">Instagram</a>
            </p>
        </div>
    </footer>
</body>

</html>