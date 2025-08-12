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
        $sql = "SELECT a.*, g.name AS genre_name,
                (SELECT COUNT(*) FROM comments WHERE comments.anime_id = a.id) AS comment_count
            FROM anime a
            LEFT JOIN anime_genres ag ON a.id = ag.anime_id
            LEFT JOIN genres g ON ag.genre_id = g.id
            ORDER BY a.views DESC 
            LIMIT 6";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }
    public function Find($id){
        $sql = "SELECT 
    a.*, 
    g.id AS genre_id, 
    g.name AS genre_name, 
    (SELECT COUNT(*) 
     FROM comments 
     WHERE comments.anime_id = a.id) AS comment_count
FROM anime a
LEFT JOIN anime_genres ag ON a.id = ag.anime_id
LEFT JOIN genres g ON ag.genre_id = g.id
WHERE a.id = :id";
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

public function AllGenres() {
    $sql = "SELECT * FROM genres";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function UpdateGenres($genreId) {
    try {
        // 1. Kiểm tra xem đã tồn tại chưa
        $checkSql = 'SELECT COUNT(*) FROM `anime_genres` 
                     WHERE `anime_id` = :anime_id AND `genre_id` = :genre_id';
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->bindParam(':anime_id', $genreId['anime_id'], PDO::PARAM_INT);
        $checkStmt->bindParam(':genre_id', $genreId['genre_id'], PDO::PARAM_INT);
        $checkStmt->execute();

        $exists = $checkStmt->fetchColumn();

        if ($exists > 0) {
            // 2. Nếu tồn tại → UPDATE
            $updateSql = 'UPDATE `anime_genres`
                          SET `genre_id` = :genre_id
                          WHERE `anime_id` = :anime_id';
            $updateStmt = $this->conn->prepare($updateSql);
            $updateStmt->bindParam(':anime_id', $genreId['anime_id'], PDO::PARAM_INT);
            $updateStmt->bindParam(':genre_id', $genreId['genre_id'], PDO::PARAM_INT);
            return $updateStmt->execute();
        } else {
            // 3. Nếu chưa tồn tại → INSERT
            $insertSql = 'INSERT INTO `anime_genres` (`anime_id`, `genre_id`)
                          VALUES (:anime_id, :genre_id)';
            $insertStmt = $this->conn->prepare($insertSql);
            $insertStmt->bindParam(':anime_id', $genreId['anime_id'], PDO::PARAM_INT);
            $insertStmt->bindParam(':genre_id', $genreId['genre_id'], PDO::PARAM_INT);
            return $insertStmt->execute();
        }
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

public function Genres(){
    $sql='SELECT * FROM `genres`';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function FindGenre($id) {
    $sql = "SELECT * FROM `genres` WHERE `id` = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function UpdateGenre($id, $data) {
    $sql = "UPDATE `genres` SET `name` = :name WHERE `id` = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();

}
public function deleteGenres($id) {
    $sql = "DELETE FROM `genres` WHERE `id` = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}
public function AddGenres($data){
    $sql = "INSERT INTO `genres`(`name`) VALUES (:name)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':name', $data['name']);
    return $stmt->execute();
}
}