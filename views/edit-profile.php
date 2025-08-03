<?php require_once './views/layout/header.php'; ?>

<?php
// Xoá giá trị user nếu bạn không muốn hiển thị thông tin từ DB
// $user = $_SESSION['user'] ?? null;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa thông tin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .edit-profile-card {
            max-width: 700px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="bg-dark text-white">

<div class="container py-5">
    <div class="card bg-secondary border-0 shadow-lg rounded-4 edit-profile-card">
        <div class="p-4">
            <h5 class="mb-4 text-center"><i class="bi bi-pencil-square me-2"></i>Chỉnh sửa thông tin</h5>
            <form action="<?= BASE_URL . '?act=update-profile&id=' . $user['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="username" class="form-label"><i class="bi bi-person-fill me-1"></i>Username</label>
                    <input type="text" class="form-control bg-dark text-white border-light" id="username"
                           name="username" placeholder="Nhập username...">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-envelope-fill me-1"></i>Email</label>
                    <input type="email" class="form-control bg-dark text-white border-light" name="email"
                           placeholder="Nhập email...">
                </div>

                <div class="mb-3">
                    <label for="avata" class="form-label"><i class="bi bi-image-fill me-1"></i>Ảnh đại diện mới</label>
                    <input type="file" class="form-control bg-dark text-white border-light" id="avata" name="avata">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="?act=profile" class="btn btn-outline-light">
                        <i class="bi bi-arrow-left me-1"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php require_once './views/layout/footer.php'; ?>
