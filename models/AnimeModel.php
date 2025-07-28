<?php 
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class AnimeModel 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Viết truy vấn danh sách sản phẩm 
    public function getAllProduct()
    {
        
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



}

/**
 * Establishes a connection to the anime_db database using PDO.
 */
