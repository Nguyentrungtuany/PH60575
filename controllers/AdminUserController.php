<?php
require_once __DIR__ . '/../models/UserModel.php';

class AdminUserController {
    public $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function list() {
        $users = $this->userModel->All();
        require_once __DIR__ . '/../views/admin/index-admin.php';
    }

    public function Delete($id) {
        $id =$_GET['id'];
        $delete = $this->userModel->Delete($id);
        if($delete) {
            header("Location: ".BASE_URL. "admin/index.php");
        } else {
            echo "Error deleting user.";
        }
    }
    public function edit($id) {
        $user = $this->userModel->All();
        $id = $_GET['id'];
        $user = $this->userModel->Find($id);
        require_once __DIR__ . '/../views/admin/edit-admin.php';
    }

   public function update() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'username'      => $_POST['username'],
            'email'         => $_POST['email'],
            'role'          => $_POST['role'],
            'password_hash' => $_POST['password_hash'],
        ];

        $id = $_GET['id'];
        $user = $this->userModel->Find($id);

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

        $return = $this->userModel->update($id, $data);

        if ($return) {
            header("Location: " . BASE_URL_ADMIN . "?act=index-admin");
            exit;
        } else {
            echo "Error updating user.";
        }
    }
}

    public function create(){
        $user = $this->userModel->All();
        require_once __DIR__ . '/../views/admin/add-admin.php';
        
    }

    // public function add() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $data = [
    //             'username'      => $_POST['username'],
    //             'email'         => $_POST['email'],
    //             'role'          => $_POST['role'],
    //             'password_hash' => $_POST['password_hash'],
    //             'created_at' => date('Y-m-d H:i:s')
    //         ];

    //         if (isset($_FILES['avata'])) {
    //             $data['avata'] = uploadFile($_FILES['avata'], 'imganime');
    //         } else {
    //             $data['avata'] = null; // Hoặc giá trị mặc định nếu không có ảnh
    //         }

    //         $this->userModel->add($data);
    //         header("Location: " . BASE_URL_ADMIN . "?act=index-admin");
    //         exit;
    //     }
    // }

    public function add() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'username'       => $_POST['username'],
            'email'          => $_POST['email'],
            'password_hash'  => $_POST['password_hash'],
            'role'           => $_POST['role'],
        ];

        // Kiểm tra nếu có file upload
        if (isset($_FILES['avata']) && $_FILES['avata']['error'] === 0) {
            $data['avata'] = uploadFile($_FILES['avata'], 'imganime');
        } else {
            // ❗ Nếu không upload thì gán ảnh mặc định
            $data['avata'] = 'admin/assets/img/team-2.jpg';
        }

        // Gọi hàm lưu vào DB
        $this->userModel->add($data);

        header("Location: " . BASE_URL_ADMIN . "?act=index-admin");
        exit;
    }

    // Nếu GET thì load form
    // require_once './views/admin/add-admin.php';
}

}
