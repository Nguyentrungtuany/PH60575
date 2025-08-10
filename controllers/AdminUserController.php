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
        ];

        $id = $_GET['id'];
        $user = $this->userModel->Find($id);
        if (empty($data['password_hash'])) {
            $data['password_hash'] = $user['password_hash'];
        }

        if (isset($_FILES['avata']) && $_FILES['avata']['error'] == 0) {
            if (!empty($user['avata'])) {
                $oldAvata = PATH_ASSETS_UPLOADS . $user['avata'];
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

    public function add() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'username'       => $_POST['username'],
            'email'          => $_POST['email'],
            // 'password_hash'  => $_POST['password_hash'],
            'role'           => $_POST['role'],
        ];

        if (isset($_FILES['avata']) && $_FILES['avata']['error'] === 0) {
            $data['avata'] = uploadFile($_FILES['avata'], 'imganime');
        } else {
            $data['avata'] = 'admin/assets/img/team-2.jpg';
        }

        $this->userModel->add($data);

        header("Location: " . BASE_URL_ADMIN . "?act=index-admin");
        exit;
    }
}
public function cmt(){
    $cmt = $this->userModel->cmt();

    require_once __DIR__ . '/../views/admin/cmt-admin.php';
}
public function deleteCmt($id) {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: index.php?act=login');
        exit;
    }
    $return = $this->userModel->deleteCmt($id);
    if ($return) {
        header("Location: " . BASE_URL_ADMIN . "?act=cmt-admin");
        exit;
    } else {
        echo "Error deleting comment.";
    }
}
}
