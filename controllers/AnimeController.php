<?php
// có class chứa các function thực thi xử lý logic
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/AnimeModel.php';

class AnimeController
{
    public $modelProduct;
    public $modeluser;

    public function __construct()
    {
        $this->modelProduct = new AnimeModel();
        $this->modeluser = new UserModel();

    }

    public function Home()
    {
        $animes = $this->modelProduct->getTrendingAnimes(); // lấy danh sách trending
        
        require_once './views/index.php'; // truyền $animes sang view

    }

    public function categories()
    {
        require_once './views/categories.php';

    }
    public function details()
    {
        require_once './views/anime-details.php';

    }
    public function watching()
    {
        require_once './views/anime-watching.php';

    }
    public function blog_details()
    {
        require_once './views/blog-details.php';

    }
    public function signup()
    {
        require_once './views/signup.php';

    }
    // public function login()
    // {
    //     require_once './views/login.php';

    // }
    public function blog()
    {
        require_once './views/blog.php';

    }
    
    public function login() {
        include './views/login.php'; // Hiển thị form login
    }

    public function handle_login() {
        $email = $_POST['email'];
        $password = $_POST['password_hash'];

        $user = $this->modeluser->findByEmail($email);
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user'] = $user;
        $username = $_SESSION['user']['username']; 

            if ($user['role'] === 'admin') {
                header('Location: ./admin/index.php');
                exit; // 🔥 BẮT BUỘC
            } else {
                header('Location: index.php');
                exit;
            }
        } else {
            echo "<script>alert('Sai email hoặc mật khẩu'); window.location.href='?act=login';</script>";
            exit;
        }
    }

    public function handle_signup() {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password_hash'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($this->modeluser->findByEmail($email)) {
        echo "<script>alert('Email đã tồn tại'); window.location.href='?act=signup';</script>";
        return;
    }
    if ($password !== $confirm) {
        echo "<script>alert('Mật khẩu không khớp'); window.location.href='?act=signup';</script>";
        return;
    }
    
    // Mã hoá mật khẩu
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Tạo người dùng
    $this->modeluser->createUser($username, $email, $hash);

    echo "<script>alert('Đăng ký thành công!'); window.location.href='?act=login';</script>";
}

    public function search() {
    $keyword = $_GET['keyword'] ?? '';
    $animes = $this->modelProduct->searchAnime($keyword); // gọi hàm truy vấn SQL

    require_once './views/anime-search.php'; // View kết quả tìm kiếm
}

public function logout() {
    session_start(); // Nếu chưa có thì gọi lại
    session_unset(); // Xóa toàn bộ biến session
    session_destroy(); // Hủy session
    header("Location: index.php"); // Chuyển hướng về trang chủ hoặc login
    exit;
}

public function profile(){
    require_once './views/profile.php'; // View trang cá nhân
    // require_once './views/layout/header.php';

}

}
