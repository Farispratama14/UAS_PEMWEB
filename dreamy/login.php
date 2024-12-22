<?php
require_once 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitasi input
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    $db = new Koneksi();
    $conn = $db->getConn(); // Gunakan getter untuk mendapatkan koneksi

    // Periksa email dan password
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: inventory.php");
            exit;
        } else {
            $error = "Wrong password!";
        }
    } else {
        $error = "Email not registered!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            font-size: 14px;
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

        input[type="email"], input[type="password"], button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            outline: none;
            transition: 0.3s ease;
        }

        input[type="email"]:focus, input[type="password"]:focus {
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

        .register-link {
            color: #ff4b5c;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="logoboneka.png" alt="Login Logo">
        <h3>Dreamy Plushie Co </h3>
        <?php if (isset($error)) : ?>
            <div class="notification error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <div class="checkbox-container">
                <input type="checkbox" id="agree" name="agree" required>
                <label for="agree">I agree with the terms of service</label>
            </div>

            <button type="submit" id="login-btn" disabled>Login</button>
        </form>
        <p>Don't have an account yet? <a href="register.php" class="register-link">Register here</a></p>
        <footer>&copy; <?php echo date("Y"); ?> Login System</footer>
    </div>

    <script>
        const agreeCheckbox = document.getElementById('agree');
        const loginButton = document.getElementById('login-btn');
        
        agreeCheckbox.addEventListener('change', function () {
            loginButton.disabled = !this.checked;
        }); 
    </script>
</body>
</html>
