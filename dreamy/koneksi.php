<?php
class Koneksi {
    private $host = "127.0.0.1";
    private $user = "root";
    private $password = "";
    private $dbname = "test_db";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function getConn() {
        return $this->conn;
    }

    public function getMahasiswa() {
        $sql = "SELECT * FROM tblmahasiswa";
        $result = $this->conn->query($sql);
        $data = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // Tambah barang baru
    public function addItem($itemName, $stock) {
        $stmt = $this->conn->prepare("INSERT INTO items (item_name, stock) VALUES (?, ?)");
        $stmt->bind_param("si", $itemName, $stock);
        $stmt->execute();
        $stmt->close();
    }

    // Tambah transaksi
    public function addTransaction($itemId, $type, $quantity) {
        // Update stok barang terlebih dahulu
        if ($type === 'in') {
            $sql = "UPDATE items SET stock = stock + ? WHERE id = ?";
        } else {
            $sql = "UPDATE items SET stock = stock - ? WHERE id = ? AND stock >= ?";
        }
        $stmt = $this->conn->prepare($sql);
        if ($type === 'in') {
            $stmt->bind_param("ii", $quantity, $itemId);
        } else {
            $stmt->bind_param("iii", $quantity, $itemId, $quantity);
        }
        $stmt->execute();
        $stmt->close();

        // Catat transaksi
        $stmt = $this->conn->prepare("INSERT INTO transactions (item_id, transaction_type, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $itemId, $type, $quantity);
        $stmt->execute();
        $stmt->close();
    }

    // Ambil semua barang
    public function getItems() {
        $result = $this->conn->query("SELECT * FROM items");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Ambil semua transaksi
    public function getTransactions() {
        $result = $this->conn->query("
            SELECT transactions.*, items.item_name 
            FROM transactions 
            LEFT JOIN items ON transactions.item_id = items.id
        ");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}
?>

