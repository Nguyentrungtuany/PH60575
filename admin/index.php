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
    
    'handle_login' => (new AnimeController())->handle_login(),
    '/' => (new AdminUserController())->list(),
    'index-admin' => (new AdminUserController())->list(),
    'delete' => (new AdminUserController())->Delete($_GET['id'] ?? null),
    'edit-admin' => (new AdminUserController())->edit($_GET['id'] ?? null),
    'update-admin' => (new AdminUserController())->update(),
    'add-admin' => (new AdminUserController())->add(), 
    'create-admin' => (new AdminUserController())->create(),
    'anime-admin' => (new AdminAnimeController())->list(),
    'anime-add' => (new AdminAnimeController())->add(),
    'delete-anime' => (new AdminAnimeController())->Delete($_GET['id'] ?? null),
    'edit-anime' => (new AdminAnimeController())->edit($_GET['id'] ?? null),
    'update-anime' => (new AdminAnimeController())->update(),
    'add-anime' => (new AdminAnimeController())->add(),
    'create-anime' => (new AdminAnimeController())->create(),
    'logout' => (new AnimeController())->logout(),
    'update-profile' => (new AnimeController())->updateProfile(),
    'cmt-admin' => (new AdminUserController())->cmt(),
    'delete-cmt' => (new AdminUserController())->deleteCmt($_GET['id'] ?? null),
    'genres-admin' => (new AdminAnimeController())->genres(),
    'add-genres' => (new AdminAnimeController())->addGenres(),
    'create-genres' => (new AdminAnimeController())->createGenres(),
    'edit-genres' => (new AdminAnimeController())->editGenres($_GET['id'] ?? null),
    'update-genres'=> (new AdminAnimeController())->updateGenre(),
    'delete-genres' => (new AdminAnimeController())->deleteGenres($_GET['id'] ?? null),
    default => require_once '../views/404.php'
};
?>