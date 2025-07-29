<?php 
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class AnimeModel 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function All(){
        // $sql = "SELECT co.*, ins.name as instructor_name  FROM courses as co 
        // JOIN instructor as ins
        // ON co.instructor_id = ins.id";
        $sql = "SELECT * FROM anime";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }
    public function Find($id){
        $sql = "SELECT * FROM anime WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function Delete($id){
        $sql = "DELETE FROM anime WHERE `anime`.`id` = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();

    }

    public function update($id,$data){
        $sql = "UPDATE `anime` SET `title` = :title,
         `description` = :description, `release_year` = :release_year,
          `status` = :status, `poster_url` = :poster_url, `trailer_url` = :trailer_url,
           `episodes_total` = :episodes_total, `episodes_released` = :episodes_released WHERE `anime`.`id` = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':release_year', $data['release_year']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':poster_url', $data['poster_url']);
        $stmt->bindParam(':trailer_url', $data['trailer_url']);
        $stmt->bindParam(':episodes_total', $data['episodes_total']);
        $stmt->bindParam(':episodes_released', $data['episodes_released']);
        // $stmt->bindParam(':created_at', $data['created_at']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function add($data) {
        $sql = "INSERT INTO `anime`(`id`, `title`, `description`, `release_year`, `status`, `poster_url`, `trailer_url`, `views`, `episodes_total`, `episodes_released`) 
                VALUES (:id, :title, :description, :release_year, :status, :poster_url, :trailer_url, :views, :episodes_total, :episodes_released)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':release_year', $data['release_year']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':poster_url', $data['poster_url']);
        $stmt->bindParam(':trailer_url', $data['trailer_url']);
        $stmt->bindParam(':views', $data['views']);
        $stmt->bindParam(':episodes_total', $data['episodes_total']);
        $stmt->bindParam(':episodes_released', $data['episodes_released']);
        return $stmt->execute();
    }

    // Viết truy vấn danh sách sản phẩm 
    public function getAllProduct()
    {
        
    }

    public function getAllAnime() {
    $sql = "SELECT * FROM anime ORDER BY id ASC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function getTrendingAnimes() {
    $sql = "SELECT a.*, g.name AS genre_name,
                (SELECT COUNT(*) FROM comments WHERE comments.anime_id = a.id) AS comment_count
            FROM anime a
            LEFT JOIN anime_genres ag ON a.id = ag.anime_id
            LEFT JOIN genres g ON ag.genre_id = g.id
            ORDER BY a.views DESC 
            LIMIT 6";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

//     public function searchAnime($keyword) {
//     $keyword = "%" . str_replace(" ", "", strtolower($keyword)) . "%";
//     $sql = "SELECT * FROM anime WHERE REPLACE(LOWER(title), ' ', '') LIKE :keyword";
//     $stmt = $this->conn->prepare($sql);
//     $stmt->bindParam(":keyword", $keyword);
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

public function searchAnime($keyword) {
    $keyword = "%" . str_replace(" ", "", strtolower($keyword)) . "%";
     $sql = "SELECT 
                a.*, 
                g.name AS genre_name,
                (
                    SELECT COUNT(*) 
                    FROM comments 
                    WHERE comments.anime_id = a.id
                ) AS comment_count
            FROM anime a
            LEFT JOIN anime_genres ag ON a.id = ag.anime_id
            LEFT JOIN genres g ON ag.genre_id = g.id
            WHERE REPLACE(LOWER(a.title), ' ', '') LIKE :keyword
            ORDER BY a.views DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":keyword", $keyword);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}

/**
 * Establishes a connection to the anime_db database using PDO.
 */
