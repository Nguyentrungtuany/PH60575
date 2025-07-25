<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}

function uploadFile($file, $folderSave) {
    $file_upload = $file;
    $fileName = time() . '_' . $file_upload['name'];

    // Tạo đường dẫn thư mục cần lưu, bắt buộc có 'uploads/' phía trước
    $relativeFolder = 'uploads/' . trim($folderSave, '/'); // Ví dụ: uploads/imganime
    $pathStorage = $relativeFolder . '/' . $fileName;

    $tmp_file = $file_upload['tmp_name'];
    $pathSave = PATH_ROOT . $pathStorage; // Đường dẫn tuyệt đối

    // Tạo thư mục nếu chưa có
    if (!is_dir(PATH_ROOT . $relativeFolder)) {
        mkdir(PATH_ROOT . $relativeFolder, 0777, true);
    }

    if (move_uploaded_file($tmp_file, $pathSave)) {
        return $pathStorage; // Trả lại đường dẫn tương đối để lưu vào DB
    }

    return null;
}


function deleteFile($file){
    $pathDelete = PATH_ROOT . $file;
    if (file_exists($pathDelete)) {
        unlink($pathDelete); // Hàm unlink dùng để xóa file
    }
}
