<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="title">Tiêu đề</label>
        <input type="text" name="title" id="title" value="{{ $post->title }}" required>
    </div>
    <div>
        <label for="content">Nội dung</label>
        <textarea name="content" id="content" required>{{ $post->content }}</textarea>
    </div>
    <button type="submit">Cập nhật bài viết</button>
</form>
