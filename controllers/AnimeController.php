<?php
// có class chứa các function thực thi xử lý logic
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/AnimeModel.php';

class AnimeController
{
    public $modelanime;
    public $userModel;

    public function __construct()
    {
        $this->modelanime = new AnimeModel();
        $this->userModel = new UserModel();

    }

    public function Home()
    {
        $animes = $this->modelanime->getTrendingAnimes(); // lấy danh sách trending
        
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

        $user = $this->userModel->findByEmail($email);
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user'] = $user;
        $username = $_SESSION['user']['username']; 

            if ($user['role'] === 'admin') {
                header('Location: index.php');
                exit; 
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

    if ($this->userModel->findByEmail($email)) {
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
    $this->userModel->createUser($username, $email, $hash);

    echo "<script>alert('Đăng ký thành công!'); window.location.href='?act=login';</script>";
}

    public function search() {
    $keyword = $_GET['keyword'] ?? '';
    $animes = $this->modelanime->searchAnime($keyword); // gọi hàm truy vấn SQL

    require_once './views/anime-search.php'; // View kết quả tìm kiếm
}

public function logout() {
    session_start(); // Nếu chưa có thì gọi lại
    session_unset(); // Xóa toàn bộ biến session
    session_destroy(); // Hủy session
    header("Location: index.php"); // Chuyển hướng về trang chủ hoặc login
    exit;
}

public function profile($id){
    $users = $this->userModel->Find($id);
    require_once './views/profile.php';

}
public function editProfile($id){
    $user = $this->userModel->All();
    $id = $_GET['id'];
    $user = $this->userModel->Find($id);
    require_once './views/edit-profile.php'; 

}


public function updateProfile(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'username'      => $_POST['username'] ,
            'email'         => $_POST['email'] ,
            'avata'         => null,
        ];

        $id = $_GET['id'];
        $user = $this->userModel->Find($id);
        if (empty($data['username'])) {
            $data['username'] = $user['username'];
        }
        if (empty($data['email'])) {
            $data['email'] = $user['email'];
        }
        if (isset($_FILES['avata']) && $_FILES['avata']['error'] == 0) {
            if (!empty($user['avata'])) {
                $oldAvata = PATH_ASSETS_UPLOADS . $user['avata']; // hoặc dùng đường dẫn trực tiếp
                if (file_exists($oldAvata)) {
                    unlink($oldAvata);
                }
            }
            $data['avata'] = uploadFile($_FILES['avata'], 'imganime');
        } else {
            $data['avata'] = $user['avata'];
        }

        $return = $this->userModel->updateProfile($id, $data);

        if ($return) {
            header("Location: " . BASE_URL . "?act=profile&id=" . $id);
            exit;
        } else {
            echo "Error updating user.";
        }
    }
}

public function animeDetail($id) {
    $anime = $this->modelanime->Find($id);
    $comments = $this->userModel->comment($id);

    require_once './views/anime-details.php'; // Hiển thị chi tiết anime
}
public function addcmt($id) {
    if (!isset($_SESSION['user'])) {
        echo "";
        return;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'user_id' => $_SESSION['user']['id'],
            'anime_id' => $id,
            'content' => $_POST['content']
        ];
        $return = $this->userModel->addcmt($data);
        if($return){
            header("Location: " . BASE_URL . "?act=anime-details&id=" . $id);
            exit;
        }else{
            echo "Lỗi !!!";
        }
       
    }
}

}