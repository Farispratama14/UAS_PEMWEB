<?php
require_once 'koneksi.php';

// Membuat objek koneksi
$db = new Koneksi();
$conn = $db->getConn(); // Mengakses koneksi menggunakan getter

$notification = ""; // Variabel untuk menampung pesan notifikasi
$registrationSuccess = false; // Status keberhasilan registrasi

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    $passwordAgain = isset($_POST['password-again']) ? trim($_POST['password-again']) : null;

    // Validasi input
    if (!$email || !$username || !$password || !$passwordAgain) {
        $notification = "All fields must be filled in!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $notification = "Invalid email format!";
    } elseif ($password !== $passwordAgain) {
        $notification = "Passwords don't match!";
    } else {
        // Hash password untuk keamanan
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Cek apakah email sudah terdaftar
        $sqlCheck = "SELECT * FROM users WHERE email = ?";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bind_param("s", $email);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            $notification = "Email has been registered. Please use another email or login.";
        } else {
            // Insert data ke tabel users
            $sqlInsert = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("sss", $username, $email, $hashedPassword);

            if ($stmtInsert->execute()) {
                $notification = "Registration successful!";
                $registrationSuccess = true;
            } else {
                $notification = "There is an error " . $stmtInsert->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ff7eb3, #ffa69e);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            width: 450px;
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            color: #333;
            text-align: center;
        }

        h1 {
            margin-top: 20px;
            margin-bottom: 10px;
            color: #ff4b5c;
            font-family: sans-serif;
            font-size: 25px;
        }

        h3 {
            margin-top: 20px;
            margin-bottom: 10px;
            color: #ff4b5c;
            font-family:cursive;
            font-size: 32px;
        }
        img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .notification {
            margin-bottom: 17px;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-size: 14px;
        }

        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
            text-align: left;
        }

        input[type="text"], input[type="email"], input[type="password"], button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            outline: none;
            transition: 0.3s ease;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
            border-color: #ff4b5c;
            box-shadow: 0 0 5px rgba(255, 75, 92, 0.5);
        }

        button {
            background: #ff4b5c;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s ease;
        }

        button:disabled {
            background: #ffb3ba;
            cursor: not-allowed;
        }

        button:hover:enabled {
            background: #e63950;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .checkbox-container input {
            margin-right: 10px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.85rem;
            color: #666;
        }

        .login-link {
            color: #ff4b5c;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="logoboneka.png" alt="Registration Logo">
        <h3>Dreamy Plushie Co </h3>
        <?php if ($notification): ?>
            <div class="notification <?php echo $registrationSuccess ? 'success' : 'error'; ?>">
                <?php echo $notification; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="password-again">Password Again:</label>
            <input type="password" id="password-again" name="password-again" required>

            <div class="checkbox-container">
                <input type="checkbox" id="agree" name="agree" required>
                <label for="agree">I agree with the terms of service</label>
            </div>

            <?php if ($registrationSuccess): ?>
                <div class="checkbox-container">
                    <input type="checkbox" id="success-checkbox" checked disabled>
                    <label for="success-checkbox">Registration successful</label>
                </div>
            <?php endif; ?>

            <button type="submit" id="register-btn" disabled>Register</button>
        </form>
        <p>Already have an account? <a href="login.php" class="login-link">Login</a></p>
        <footer>&copy; <?php echo date("Y"); ?> Registration System</footer>
    </div>

    <script>
        const agreeCheckbox = document.getElementById('agree');
        const registerButton = document.getElementById('register-btn');

        agreeCheckbox.addEventListener('change', function () {
            registerButton.disabled = !this.checked;
        });

        document.getElementById("register-btn").addEventListener("click", function() {
            const username = document.getElementById("username").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const passwordAgain = document.getElementById("password-again").value;

            if (password !== passwordAgain) {
                alert("Passwords do not match!");
            } else if (!agreeCheckbox.checked) {
                alert("You must agree to the terms of service!");
            }
        });
        
    </script>
</body>
</html>
