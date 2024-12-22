<?php
require_once 'koneksi.php';
session_start();

$db = new Koneksi();

// Tambahkan barang baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_item'])) {
    $itemName = htmlspecialchars($_POST['item_name']);
    $stock = intval($_POST['stock']);
    $db->addItem($itemName, $stock);
    header("Location: inventory.php");
    exit();
}

// Tambahkan transaksi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['transaction'])) {
    $itemId = intval($_POST['item_id']);
    $type = htmlspecialchars($_POST['transaction_type']);
    $quantity = intval($_POST['quantity']);
    $db->addTransaction($itemId, $type, $quantity);
    header("Location: inventory.php");
    exit();
}

// Dapatkan data barang dan transaksi
$items = $db->getItems();
$transactions = $db->getTransactions();

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg,#ff7eb3, #ff758c);
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .top-bar {
            justify-content: space-between;
            align-items: left;
            margin-bottom: 50px;
            margin-top: 20px;
        }
        .top-bar button {
            background:#ff7eb3,;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .top-bar button:hover {
            background: #ff4b5c;
            box-shadow: 0 4px 8px rgba(14, 113, 229, 0.4);
        }
        h1 {
            text-align: center;
            font-weight: 600;
            font-size: 30px;
            color:rgb(0, 0, 0);
            margin-bottom: 50px;
        }

        h2 {
            text-align: center;
            font-weight: 600;
            font-size: 24px;
            color:rgb(220, 7, 28);
            margin-bottom: 20px;
            margin-top: 70px;
        }

        h3 {
            margin-top: 20px;
            margin-bottom: 10px;
            color: #ff4b5c;
            font-family:cursive;
            font-size: 35px;
            text-align: center;
        }

        img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 0 auto 15px;
        }

        form {
            margin-bottom: 30px;

        
        }
        input, select {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }
        button {
            background: #ff4b5c;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 50px;
        }

        button:hover {
            background:rgb(168, 171, 156);
            box-shadow: 0 4px 8px rgba(14, 113, 229, 0.4);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            font-size: 0.9rem;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #ff4b5c;
            color: white;
        }
        tbody tr:nth-child(even) {
            background-color: #f4f4f4;
        }
        tbody tr:hover {
            background-color: #e6f7ff;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="logoboneka.png" alt="Login Logo">
        <h3>Dreamy Plushie Co </h3>
        <!-- Top Bar -->
        <div class="top-bar">
            <a href="tambah.php"><button>Employee data</button></a>
            <a href="?logout=true"><button>Logout</button></a>
        </div>

        <h1>INVENTORY SYSTEM</h1>

        <!-- Tambah Barang -->
        <form method="POST" action="">
            <input type="text" name="item_name" placeholder="Name of Item" required>
            <input type="number" name="stock" placeholder="Initial Stock Amount" min="1" required>
            <button type="submit" name="add_item">Add Items</button>
        </form>

        <!-- Transaksi -->
        <h2>Item Transactions</h2>
        <form method="POST" action="">
            <select name="item_id" required>
                <option value="" disabled selected>Select Items</option>
                <?php foreach ($items as $item): ?>
                    <option value="<?= $item['id'] ?>"><?= $item['item_name'] ?> (Stok: <?= $item['stock'] ?>)</option>
                <?php endforeach; ?>
            </select>
            <select name="transaction_type" required>
                <option value="" disabled selected>Transaction Type</option>
                <option value="in">Income Item</option>
                <option value="out">Exit Item</option>
            </select>
            <input type="number" name="quantity" placeholder="Total" min="1" required>
            <button type="submit" name="transaction">Submit Transaction</button>
        </form>

        <!-- Daftar Barang -->
        <h2>List of Items</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name of Item</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= htmlspecialchars($item['item_name']) ?></td>
                        <td><?= $item['stock'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Riwayat Transaksi -->
        <h2>Transaction History </h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nem of Item</th>
                    <th>Type</th>
                    <th>Total</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?= $transaction['id'] ?></td>
                        <td><?= htmlspecialchars($transaction['item_name']) ?></td>
                        <td><?= $transaction['transaction_type'] === 'in' ? 'Masuk' : 'Keluar' ?></td>
                        <td><?= $transaction['quantity'] ?></td>
                        <td><?= $transaction['date'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <!-- Browser Storage -->
    <script>
        // Menyimpan data ke Local Storage
        localStorage.setItem("pageViews", "<?php echo $_SESSION['count']; ?>");

        // Membaca data dari Local Storage
        const views = localStorage.getItem("pageViews");
        console.log("Page views stored in local storage: " + views);

        // Validasi input dengan JavaScript (Manipulasi DOM)
        document.getElementById("form-karyawan").addEventListener("submit", function (e) {
            const nama = document.getElementById("nama").value.trim();
            const no_hp = document.getElementById("no_hp").value.trim();
            const posisi = document.getElementById("posisi").value.trim();

            if (!nama || !no_hp || !posisi) {
                e.preventDefault();
                alert("Semua field harus diisi!");
            }
        });
    </script>
</body>
</html>
