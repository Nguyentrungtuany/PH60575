<?php 
session_start();
require_once './commons/env.php'; 
require_once './commons/function.php'; 
require_once './controllers/AnimeController.php';
require_once './controllers/AdminUserController.php'; 
require_once './controllers/AdminAnimeController.php';
require_once './models/AnimeModel.php';
require_once './models/UserModel.php';

$act = $_GET['act'] ?? '/';



match ($act) {
    '/' => (new AnimeController())->Home(),
    'index' => (new AnimeController())->Home(),
    'categories' => (new AnimeController())->categories(),
    'anime-watching' => (new AnimeController())->watching(),
    'blog-details' => (new AnimeController())->blog_details(),
    'signup' => (new AnimeController())->signup(),
    'login' => (new AnimeController())->login(),
    'blog' => (new AnimeController())->blog(),
    'update-admin' => (new AdminUserController())->update(),
    'index-admin' => (new AdminUserController())->list(),
    'handle_login' => (new AnimeController())->handle_login(),
    'anime-search' => (new AnimeController())->search(),
    'handle_signup' => (new AnimeController())->handle_signup(),
    'logout' => (new AnimeController())->logout(),
    'profile' => (new AnimeController())->profile($_GET['id'] ?? null), 
    'edit-profile' => (new AnimeController())->editProfile($_GET['id'] ?? null),
    'update-profile' => (new AnimeController())->updateProfile(),
    'anime-details' => (new AnimeController())->animeDetail($_GET['id'] ?? null),
    'addcmt' => (new AnimeController())->addcmt($_GET['id'] ?? null),
    default => require_once './views/404.php'

};