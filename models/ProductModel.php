<?php
// ProductModel.php


class ProductModel {
private $conn;

public function __construct(){
    // Ambil konfigurasi database dari file db.php
    include 'config/db.php';

    global $conn;
    // Membuat koneksi
    $this->conn = $conn;

    // Periksa apakah koneksi berhasil
    if ($this->conn->connect_error) {
        die("Connection failed: " . $this->conn->connect_error);
    }
}
    public function getAllProduct() {
        $sql = "SELECT * FROM products";
        return $this->conn->query($sql);
    }

    public function addProduct($data) {
        $sql = "INSERT INTO products (name, price, specifications, image) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdss", $data['name'], $data['price'], $data['specifications'], $data['image']);
        $stmt->execute();
    }    

    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // ProductModel.php
    public function updateProduct($id, $data) {
        // Tangani file gambar jika ada
        $target_file = $data['current_image']; // Gunakan gambar yang ada jika tidak ada file baru
        if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            $target_dir = "upload/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                die("Error uploading the file.");
            }
        }

        // Gabungkan spesifikasi dari input
        $specifications = "RAM: {$data['ram']} {$data['ram_unit']}, Storage: {$data['storage']} {$data['storage_unit']}, Condition: {$data['quality']}";

        // Update data di database
        $sql = "UPDATE products SET name = ?, price = ?, specifications = ?, image = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdssi", $data['name'], $data['price'], $specifications, $target_file, $id);

        if (!$stmt->execute()) {
            die("Error: " . $this->conn->error);
        }
    }


    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true; // Penghapusan berhasil
        } else {
            die("Error: " . $this->conn->error); // Debug jika ada error
        }
    }
    
}
?>
