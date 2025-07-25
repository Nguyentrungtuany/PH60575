<?php
session_start();

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once '../controllers/AnimeController.php';
require_once '../controllers/AdminUserController.php'; 
require_once '../controllers/AdminAnimeController.php'; // Thêm AnimeController nếu cần

// Require toàn bộ file Models
require_once '../models/AnimeModel.php';
require_once '../models/UserModel.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php?act=login');
    exit;
}

$act = $_GET['act'] ?? '/';

match ($act) {
    // '/'=> (new AdminAnimeController())->index(),

    // 'dashboard' => (new AdminAnimeController())->dashboard(),
    // 'product-list' => (new AdminAnimeController())->list(),
    // 'product-edit' => (new AdminAnimeController())->edit($_GET['id'] ?? null),
    // 'product-update' => (new AdminAnimeController())->update($_POST),
    'handle_login' => (new AnimeController())->handle_login(),
    '/' => (new AdminUserController())->list(),
    'index-admin' => (new AdminUserController())->list(),
    'delete' => (new AdminUserController())->Delete($_GET['id'] ?? null),
    'edit-admin' => (new AdminUserController())->edit($_GET['id'] ?? null),
    'update-admin' => (new AdminUserController())->update(),
    'add-admin' => (new AdminUserController())->add(), 
    'create-admin' => (new AdminUserController())->create(),
    default => require_once '../views/admin/404.php'
};
?>