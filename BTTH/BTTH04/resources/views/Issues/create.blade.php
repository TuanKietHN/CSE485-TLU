<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Issue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>\
    <header class="bg-dark text-white text-center py-3">
        <h1>Issue Management System</h1>
    </header>
    <div class="container mt-5">
        <h1 class="mb-4">Thêm báo cáo sự cố</h1>
        <form action="{{ route('issues.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="reported_by" class="form-label">Người báo cáo sự cố</label>
                <input type="text" class="form-control" id="reported_by" name="reported_by" required>
            </div>

            <div class="mb-3">
                <label for="computer_id" class="form-label">Tên máy tính</label>
                <select name="computer_id" id="computer_id" class="form-select" required>
                    @foreach ($computers as $computer)
                    <option value="{{ $computer->id }}">{{ $computer->computer_name }} - {{ $computer->model }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="reported_date" class="form-label">Thời gian báo cáo</label>
                <input type="datetime-local" class="form-control" id="reported_date" name="reported_date" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Thông tin</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="urgency" class="form-label">Mức độ sự cố</label>
                <select name="urgency" id="urgency" class="form-select" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái hiện tại</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="Open">Open</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Resolved">Resolved</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Gửi báo cáo</button>
        </form>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 Issue Management System</p>
    </footer>
</body>

</html>