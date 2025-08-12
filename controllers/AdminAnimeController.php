<?php
require_once __DIR__ . '/../models/AnimeModel.php';

class AdminAnimeController {
    public $AnimeModel;
    public $modeluser;

    public function __construct() {
        $this->AnimeModel = new AnimeModel();
        $this->modeluser = new UserModel();
    }
    public function index() {
        require_once '../views/admin/index-admin.php';
    }
     public function list() {
        $anime = $this->AnimeModel->All();
        require_once __DIR__ . '/../views/admin/anime-admin.php';
    }

    public function Delete($id) {
        $id =$_GET['id'];
        $delete = $this->AnimeModel->Delete($id);
        if($delete) {
            header("Location: ".BASE_URL. "admin/index.php?act=anime-admin");
        } else {
            echo "Error deleting anime.";
        }
    }
    public function edit($id) {
        $anime = $this->AnimeModel->All();
        $id = $_GET['id'];
        $anime = $this->AnimeModel->Find($id);
        $genres = $this->AnimeModel->AllGenres();
        require_once __DIR__ . '/../views/admin/edit-anime.php';
    }

   public function update() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'title'      => $_POST['title'],
            'description'         => $_POST['description'],
            'release_year'          => $_POST['release_year'],
            'trailer_url' => $_POST['trailer_url'],
            'episodes_total' => $_POST['episodes_total'],
            'episodes_released' => $_POST['episodes_released'],
        ];

        $id = $_GET['id'];
        $user = $this->AnimeModel->Find($id);
    

        if (isset($_FILES['poster_url']) && $_FILES['poster_url']['error'] == 0) {
            if (!empty($user['poster_url'])) {
                $oldAvata = PATH_ASSETS_UPLOADS . $user['poster_url']; // hoặc dùng đường dẫn trực tiếp
                if (file_exists($oldAvata)) {
                    unlink($oldAvata);
                }
            }
            $data['poster_url'] = uploadFile($_FILES['poster_url'], 'imganime');
        } else {
            $data['poster_url'] = $user['poster_url'];
        }

        $return = $this->AnimeModel->update($id, $data);
        $genreId = $this -> AnimeModel->UpdateGenres([
            'anime_id' => $id,
            'genre_id' => $_POST['genre_id']
        ]);
            print_r($genreId);
            echo "<hr>";
            print_r($data);

        if ($return) {
            header("Location: " . BASE_URL_ADMIN . "?act=anime-admin");
            exit;
        } else {
            echo "Error updating user.";
        }
    }
}

    public function create(){
        $user = $this->AnimeModel->All();
        require_once __DIR__ . '/../views/admin/add-anime.php';
        
    }
    public function add() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'title'       => $_POST['title'],
            'description'         => $_POST['description'],
            'release_year'          => $_POST['release_year'],
            'trailer_url' => $_POST['trailer_url'],
            'episodes_total' => $_POST['episodes_total'],
            'episodes_released' => $_POST['episodes_released'],
        ];

        if (isset($_FILES['poster_url']) && $_FILES['poster_url']['error'] === 0) {
            $data['poster_url'] = uploadFile($_FILES['poster_url'], 'imganime');
        } else {
            $data['poster_url'] = 'admin/assets/img/team-2.jpg';
        }

        // Gọi hàm lưu vào DB
        $this->AnimeModel->add($data);

        header("Location: " . BASE_URL_ADMIN . "?act=anime-admin");
        exit;
    }

   
}

public function genres() {
        $genres = $this->AnimeModel->Genres();
        require_once __DIR__ . '/../views/admin/genres-admin.php';
    }

    public function addGenres() {
        require_once __DIR__ . '/../views/admin/add-genres.php';
    }

    public function editGenres($id) {
        $id = $_GET['id'];
        $genre = $this->AnimeModel->FindGenre($id);
        require_once __DIR__ . '/../views/admin/edit-genres.php';
    }

    public function UpdateGenre() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
            ];
            $id = $_GET['id'];
            $this->AnimeModel->UpdateGenre($id, $data);
            header("Location: " . BASE_URL_ADMIN . "?act=genres-admin");
            exit;
        }
    }

    public function deleteGenres($id) {
        $this->AnimeModel->deleteGenres($id);
        header("Location: " . BASE_URL_ADMIN . "?act=genres-admin");
        exit;
}

public function createGenres() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'name' => $_POST['name'],
        ];

        $this->AnimeModel->AddGenres($data);
        header("Location: " . BASE_URL_ADMIN . "?act=genres-admin");
        exit;
    }
}
}
?>