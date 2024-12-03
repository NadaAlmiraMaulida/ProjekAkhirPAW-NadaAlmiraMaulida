<?php

include 'config/db.php';
class UserModel {
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
    public function register($username, $password) {
        // Periksa apakah username sudah ada
        $checkUser = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $checkUser->bind_param("s", $username);
        $checkUser->execute();
        $result = $checkUser->get_result();

        if ($result->num_rows > 0) {
            return "Username already exists. Please choose another username."; // Jika username sudah ada
        } else {
            // Masukkan user baru ke database
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $username, $passwordHash);

            if ($stmt->execute()) {
               ($stmt->execute());
               return null;
            } else {
                return "Error: " . $this->conn->error; // Jika gagal
            }
        }
    }
    
    public function login($username, $password) {
        // Query untuk mengambil data pengguna berdasarkan username
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        // Validasi password
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return data pengguna jika berhasil login
        } else {
            return false; // Return false jika gagal login
        }
    }
}
