<?php
// có class chứa các function thực thi xử lý logic
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/AnimeModel.php';

class AnimeController
{
    public $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new AnimeModel();
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
        $password = $_POST['password'];

        $user = UserModel::findByEmail($email);

        if ($user && $user['password_hash'] === $password) {
            $_SESSION['user'] = $user;
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

    


}
