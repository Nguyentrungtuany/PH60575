<?php
require_once __DIR__ . '/../commons/function.php'; // import hàm

class UserModel {
    public $conn;
    public function __construct() {
        $this->conn = connectDB(); // hàm connectDB() đã được định nghĩa rồi
    }
    public static function findByEmail($email) {
        $conn = connectDB(); 
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
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
}