<?php
require_once __DIR__ . '/../commons/function.php'; // import hàm

class UserModel {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function createUser($username, $email, $password_hash) {
        $sql = "INSERT INTO users (username, email, password_hash, role, avata)
                VALUES (:username, :email, :password, 'user', :avata)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $password_hash,
            ':avata' => 'admin/assets/img/team-2.jpg',
            // ':role' => 'user'
        ]);
    }
    

    public function findByEmail($email) {
        // $conn = connectDB();
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function All(){
        // $sql = "SELECT co.*, ins.name as instructor_name  FROM courses as co 
        // JOIN instructor as ins
        // ON co.instructor_id = ins.id";
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    public function Find($id){
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function Delete($id){
        $sql = "DELETE FROM users WHERE `users`.`id` = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();

    }

    public function update($id,$data){
        $sql = "UPDATE `users` SET `username` = :username,
         `email` = :email, `password_hash` = :password_hash, `role` = :role , `avata` = :avata
         WHERE `users`.`id` = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password_hash', $data['password_hash']);
        $stmt->bindParam(':role', $data['role']);
        // $stmt->bindParam(':created_at', $data['created_at']);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':avata', $data['avata'] );
        return $stmt->execute();
    }

    public function add($data) {
        $sql = "INSERT INTO `users` (`username`, `email`, `password_hash`, `role`, `avata`) 
                VALUES (:username, :email, :password_hash, :role, :avata)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password_hash', $data['password_hash']);
        $stmt->bindParam(':role', $data['role']);
        $stmt->bindParam(':avata', $data['avata']);
        return $stmt->execute();
    }
    public function updateProfile($id, $data) {
        $sql = "UPDATE `users` SET `username` = :username, `email` = :email, `avata` = :avata WHERE `users`.`id` = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':avata', $data['avata']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function comment($id){
        $sql = "SELECT c.*, u.* 
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.anime_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
public function addcmt($data){
    $sql = "INSERT INTO `comments` (`id`, `user_id`, `anime_id`, `content`, `created_at`) VALUES (NULL, :user_id, :anime_id, :content, CURRENT_TIMESTAMP)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':user_id', $data['user_id']);
    $stmt->bindParam(':anime_id', $data['anime_id']);
    $stmt->bindParam(':content', $data['content']);
    return $stmt->execute();
}
public function cmt(){
    $sql = "SELECT * FROM `comments`";
    $comments = $this->conn->query($sql);
    return $comments->fetchAll(PDO::FETCH_ASSOC);
}
public function deleteCmt($id){
    $sql = "DELETE FROM `comments` WHERE `comments`.`id` = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();

}


}