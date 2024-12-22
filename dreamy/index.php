<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

        h3 {
            margin-top: 20px;
            margin-bottom: 10px;
            color: #ff4b5c;
            font-family: cursive;
            font-size: 32px;
        }

        img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: white;
            background: #ff4b5c;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #e63950;
        }

        .footer {
            margin-top: 20px;
            font-size: 0.85rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="logoboneka.png" alt="Home Logo">
        <h3>Dreamy Plushie Co</h3>
        <p>Welcome to Dreamy Plushie Co!:</p>
        <button onclick="window.location.href='login.php'">Login</button>
        <button onclick="window.location.href='register.php'">Register</button>
        <footer class="footer">&copy; <?php echo date("Y"); ?> Dreamy Plushie Co</footer>
    </div>
</body>
</html>
