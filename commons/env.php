<?php 

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

define('BASE_URL'       , 'http://localhost/mvc-oop-basic-duanmau/');
define('BASE_URL_ADMIN'       , 'http://localhost/mvc-oop-basic-duanmau/admin/index.php');


define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME'    , 'anime');  // Tên database

define('PATH_ROOT'    , __DIR__ . '/../');
define('PATH_ROOT2'    , __DIR__ . '/./');

define('PATH_ASSETS_UPLOADS',   PATH_ROOT2 . 'uploads/imganime');
