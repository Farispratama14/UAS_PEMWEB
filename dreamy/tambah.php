<?php
session_start();
if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 1;
} else {
    $_SESSION['count']++;
}

// Set cookie default jika belum ada
if (!isset($_COOKIE['user'])) {
    setcookie("user", "Student", time() + 3600); // Cookie berlaku 1 jam
}

// Hapus cookie jika parameter `clear_cookie` ada
if (isset($_GET['clear_cookie'])) {
    setcookie("user", "", time() - 3600); // Menghapus cookie
    header("Location: tambah.php");
    exit();
}

// Set cookie baru berdasarkan input form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_cookie_value'])) {
    $newValue = htmlspecialchars($_POST['new_cookie_value']);
    setcookie("user", $newValue, time() + 3600); // Cookie berlaku 1 jam
    header("Location: tambah.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ff7eb3, #ff758c);
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
        h1, h2 {
            text-align: center;
            font-weight: 600;
            font-size: 23px;
            color: #ff4b5c;
            margin-bottom: 40px;
            font-size: 25px;
        }

        h3 {
            margin-top: 20px;
            margin-bottom: 50px;
            color: #ff4b5c;
            font-family:cursive;
            font-size: 35px;
            text-align: center;
        }

        h4 {
            margin-top: 20px;
            margin-bottom: 50px;
            color:rgb(0, 0, 0);
            font-family:sans-serif;
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
        label {
            display: block;
            font-weight: 300;
            margin-bottom: 10px;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f8f9fa;
        }
        input[type="text"]:focus {
            border-color: #ff4b5c;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 75, 92, 0.5);
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
            background:rgb(126, 115, 115);
            box-shadow: 0 4px 8px rgba(230, 62, 77, 0.4);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 50px;
        }
        table thead {
            background: #ff4b5c;
            color: white;
            font-weight: 600;
        }
        th, td {
            padding: 12px;
            text-align: left;
            font-size: 0.9rem;
        }
        table tbody tr:nth-child(even) {
            background-color: #ffe0e3;
        }
        table tbody tr:hover {
            background-color: #ffd3d6;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.85rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="logoboneka.png" alt="Login Logo">

        <h3>Dreamy Plushie Co </h3>
        <!-- Top Bar -->
        <div class="top-bar">
            <a href="inventory.php"><button>Inventory System</button></a>
        </div>

        <h4>EMPLOYEE</h4>
        <form method="POST" action="manage.php" id="form-karyawan">
            <label for="nama">Name:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="no_hp">No. HP:</label>
            <input type="text" id="no_hp" name="no_hp" required>

            <label for="posisi">Position:</label>
            <input type="text" id="posisi" name="posisi" required>

            <button type="submit" name="add">Add</button>
        </form>

        <h1>Employee Data</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>No. HP</th>
                    <th>Position</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="karyawan-table">
                <?php
                require_once 'koneksi.php';
                $db = new Koneksi();
                $dataKaryawan = $db->getMahasiswa();
                foreach ($dataKaryawan as $key => $row) {
                    echo "<tr>";
                    echo "<td>" . ($key + 1) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['no_hp']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['posisi']) . "</td>";
                    echo "<td>
                            <form method='POST' action='manage.php'>
                                <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                                <button type='submit'>Hapus</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h1>Session Management</h1>
        <?php
        echo "Page views: " . $_SESSION['count'];
        ?>

        <h1>Cookie Management</h1>
        <p>
            <?php
            if (isset($_COOKIE['user'])) {
                echo "Current Cookie Value: <strong>" . htmlspecialchars($_COOKIE['user']) . "</strong>";
            } else {
                echo "Cookie not set.";
            }
            ?>
        </p>
        <form method="POST" action="">
            <label for="new_cookie_value">Set Cookie Value:</label><br>
            <input type="text" id="new_cookie_value" name="new_cookie_value" placeholder="Enter new cookie value" required><br>
            <button type="submit">Set Cookie</button>
        </form>
        <br>
        <a href="?clear_cookie=true" style="color: #ff4b5c; text-decoration: none;">Hapus Cookie</a>
    </div>

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
