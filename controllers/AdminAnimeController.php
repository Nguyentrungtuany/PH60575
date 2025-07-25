<?php
class AdminAnimeController {
    public function index() {
        require_once '../views/admin/index-admin.php';
    }
    // public function dashboard() {
    //     require_once '../views/admin/dashboard.php';
    // }

    // public function list() {
    //     $products = ProductModel::getAll();
    //     require_once '../views/admin/product/list.php';
    // }

    // public function edit($id) {
    //     $product = ProductModel::findById($id);
    //     require_once '../views/admin/product/edit.php';
    // }

    // public function update($data) {
    //     ProductModel::update($data);
    //     header("Location: index.php?act=product-list");
    // }
}
?>