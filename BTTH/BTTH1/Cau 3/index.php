<?php
// Đường dẫn đến file CSV
$filename = "KTPM2.csv";
$sinhvien = [];

// Đọc file CSV
if (($handle = fopen($filename, "r")) !== FALSE) {
    // Bỏ qua dòng header
    $headers = fgetcsv($handle, 1000, ",");
    
    // Đọc từng dòng dữ liệu
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $sinhvien[] = [
            'username' => $data[0],
            'password' => $data[1],
            'lastname' => $data[2],
            'firstname' => $data[3],
            'city' => $data[4],
            'email' => $data[5],
            'course1' => $data[6]
        ];
    }
    fclose($handle);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên KTPM2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Danh sách sinh viên KTPM2</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Họ</th>
                            <th>Tên</th>
                            <th>Lớp</th>
                            <th>Email</th>
                            <th>Khóa học</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sinhvien as $sv): ?>
                        <tr>
                            <td><?= htmlspecialchars($sv['username']) ?></td>
                            <td><?= htmlspecialchars($sv['password']) ?></td>
                            <td><?= htmlspecialchars($sv['lastname']) ?></td>
                            <td><?= htmlspecialchars($sv['firstname']) ?></td>
                            <td><?= htmlspecialchars($sv['city']) ?></td>
                            <td><?= htmlspecialchars($sv['email']) ?></td>
                            <td><?= htmlspecialchars($sv['course1']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
