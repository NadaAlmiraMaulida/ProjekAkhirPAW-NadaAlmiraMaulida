<?php
// ProductController.php


class ProductController {

    private $productModel;

    public function __construct($conn){
        $this->productModel = new ProductModel($conn);
    }
    
    public function home() {
        if (!isset($_SESSION['username'])) {
            header('Location: index.php?action=login');
            exit;
        }

    
        $productModel = new ProductModel();
        $products = $productModel->getAllProduct();
        include 'views/home.php';
    }

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productModel = new ProductModel();
    
            // Gabungkan data spesifikasi dari input form
            $ram = $_POST['ram_value'] . " " . $_POST['ram_unit'];
            $storage = $_POST['storage_value'] . " " . $_POST['storage_unit'];
            $condition = $_POST['condition'];
            $specifications = "RAM: $ram, Storage: $storage, Condition: $condition";
    
            // Tangani file gambar
            $target_dir = "upload/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    
            // Persiapkan data untuk dimasukkan
            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'specifications' => $specifications,
                'image' => $target_file
            ];
    
            // Panggil metode pada model untuk menyimpan data
            $productModel->addProduct($data);
    
            // Redirect ke halaman utama
            header('Location: index.php');
            exit;
        }
    
        // Jika GET request, tampilkan halaman tambah produk
        include 'views/addProduct.php';
    }
    

    public function editProduct() {
        $id = $_GET['id'];
        $productModel = new ProductModel();
    
        // Ambil data produk berdasarkan ID
        $product = $productModel->getProductById($id);
    
        if (!$product) {
            die("Product not found!");
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Gabungkan data dari form dan informasi saat ini
            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'ram' => $_POST['ram'],
                'ram_unit' => $_POST['ram_unit'],
                'storage' => $_POST['storage'],
                'storage_unit' => $_POST['storage_unit'],
                'quality' => $_POST['quality'],
                'current_image' => $product['image'], // Gunakan gambar lama jika tidak ada yang baru
            ];
    
            // Panggil model untuk mengupdate data
            $productModel->updateProduct($id, $data);
    
            // Redirect ke halaman detail produk setelah update berhasil
            
            header('Location: index.php?action=detail&id=' . $id);
            exit;
        }
    
        // Tampilkan halaman edit form
        include 'views/editProduct.php';
    }
    
    public function detail($id)
    {
        if (!isset($_SESSION['username'])) { // Cek apakah pengguna sudah login
            header("Location: login.php");
            exit;
        }
    
        // Mengambil id produk dari URL
        $id = intval($id);
        $product = $this->productModel->getProductById($id);
    
    
        if (!$product) {
            echo "Product not found!"; // Jika produk tidak ditemukan
            exit;
        }
    
        // Kirim data produk ke view
       include 'views/detail.php';
    }

    public function deleteProduct($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_GET['id'];
            $productModel = new ProductModel();
    
            // Panggil fungsi `deleteProduct` di model
            $productModel->deleteProduct($id);
    
            // Redirect ke halaman utama setelah penghapusan
            header('Location: index.php');
            exit;
        }
    }
    
    
}
?>

