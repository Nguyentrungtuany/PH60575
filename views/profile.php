
<?php
require_once __DIR__ . '/layout/header.php';

$user = $_SESSION['user'] ?? null;
error_reporting(E_ALL);
ini_set('display_errors', 1);
// session_start();

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang cá nhân</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container py-5">
    <div class="card bg-secondary border-0 shadow-lg rounded-4">
        <div class="row g-0 align-items-center">
            <!-- Avatar -->
            <div class="col-md-4 text-center p-4 bg-dark rounded-start-4">
                <img src="<?= htmlspecialchars($user['avata']) ?>" class="rounded-circle border border-light mb-3" width="120" height="120" alt="Avatar">
                <h4 class="fw-bold mb-0"><?= htmlspecialchars($user['username']) ?></h4>
                <small class="text-light">Thành viên Anime</small>
            </div>

            <!-- Thông tin -->
            <div class="col-md-8 p-4">
                <h5 class="mb-4"><i class="bi bi-person-circle me-2"></i>Thông tin cá nhân</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-secondary text-white d-flex justify-content-between">
                        <span><i class="bi bi-person-fill me-2"></i>Họ và tên</span>
                        <strong><?= htmlspecialchars($user['fullname'] ?? 'Chưa cập nhật') ?></strong>
                    </li>
                    <li class="list-group-item bg-secondary text-white d-flex justify-content-between">
                        <span><i class="bi bi-envelope-fill me-2"></i>Email</span>
                        <strong><?= htmlspecialchars($user['email'] ?? 'Chưa cập nhật') ?></strong>
                    </li>
                </ul>
                <a href="?act=edit-profile" class="btn btn-danger mt-4">
                    <i class="bi bi-pencil-square me-1"></i> Chỉnh sửa thông tin
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
require_once __DIR__ . '/layout/footer.php';
?>