<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Issue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-dark text-white text-center py-3">
        <h1>Issue Management System</h1>
    </header>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Issue</h1>
        <form action="{{ route('issues.update', $issue->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="computer_id" class="form-label">Computer</label>
                <select name="computer_id" id="computer_id" class="form-select" required>
                    <option value="">Select Computer</option>
                    @foreach ($computers as $computer)
                    <option value="{{ $computer->id }}" {{ $computer->id == $issue->computer_id ? 'selected' : '' }}>
                        {{ $computer->computer_name }} ({{ $computer->model }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="model" class="form-label">Tên phiên bản</label>
                <input type="text" name="model" id="model" class="form-control" value="{{ $issue->computer->model }}" required>
            </div>

            <div class="mb-3">
                <label for="reported_by" class="form-label">Người báo cáo sự cố</label>
                <input type="text" name="reported_by" id="reported_by" class="form-control" value="{{ $issue->reported_by }}" required>
            </div>

            <div class="mb-3">
                <label for="reported_date" class="form-label">Thời gian báo cáo</label>
                <input type="datetime-local" name="reported_date" id="reported_date" class="form-control" value="{{ \Carbon\Carbon::parse($issue->reported_date)->format('Y-m-d\TH:i') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Thông tin</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ $issue->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="urgency" class="form-label">Mức độ sự cố</label>
                <select name="urgency" id="urgency" class="form-select" required>
                    <option value="Low" {{ $issue->urgency == 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ $issue->urgency == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ $issue->urgency == 'High' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái hiện tại</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="Open" {{ $issue->status == 'Open' ? 'selected' : '' }}>Open</option>
                    <option value="In Progress" {{ $issue->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Resolved" {{ $issue->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Issue</button>
        </form>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 Issue Management System</p>
    </footer>
</body>

</html>