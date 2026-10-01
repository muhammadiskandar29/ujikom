<?php
// koneksi database oop
class Database {
    public $conn;

    public function __construct() {
        $this->conn = mysqli_connect("localhost", "root", "", "spp");
        if (!$this->conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
    }
}

$db = new Database();
$conn = $db->conn;
?>
