<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)
session_start();

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AnimeController.php';
require_once './controllers/AdminUserController.php'; 
require_once './controllers/AdminAnimeController.php'; // Thêm AnimeController nếu cần

// Require toàn bộ file Models
require_once './models/AnimeModel.php';
require_once './models/UserModel.php';

// Route
$act = $_GET['act'] ?? '/';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    '/' => (new AnimeController())->Home(),
    'index' => (new AnimeController())->Home(),
    'categories' => (new AnimeController())->categories(),
    'anime-details' => (new AnimeController())->details(),
    'anime-watching' => (new AnimeController())->watching(),
    'blog-details' => (new AnimeController())->blog_details(),
    'signup' => (new AnimeController())->signup(),
    'login' => (new AnimeController())->login(),
    'blog' => (new AnimeController())->blog(),
    'update-admin' => (new AdminUserController())->update(),
    'index-admin' => (new AdminUserController())->list(),
    // ✅ Thêm dòng này để xử lý khi act = handle_login
    'handle_login' => (new AnimeController())->handle_login(),
};