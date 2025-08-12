<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>404 - Không tìm thấy trang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .error-container {
            height: 100vh;
        }
        .error-code {
            font-size: 120px;
            font-weight: bold;
            color: #ff4757;
        }
        .error-message {
            font-size: 20px;
            margin-bottom: 20px;
        }
        .btn-home {
            padding: 10px 25px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container d-flex flex-column justify-content-center align-items-center error-container">
    <div class="text-center">
        <div class="error-code">404</div>
        <div class="error-message">Trang bạn tìm kiếm không tồn tại.</div>
        <a href="?act=index" class="btn btn-danger btn-home">
            <i class="bi bi-house-door"></i> Quay lại trang chủ
        </a>
    </div>
</div>

<!-- Bootstrap JS + Icon -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>
</html>
