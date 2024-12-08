<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div>
        <label for="title">Tiêu đề</label>
        <input type="text" name="title" id="title" required>
    </div>
    <div>
        <label for="content">Nội dung</label>
        <textarea name="content" id="content" required></textarea>
    </div>
    <button type="submit">Lưu bài viết</button>
</form>
