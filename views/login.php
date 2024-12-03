

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Resetting default styles */
        body {
            background-color: #f5f5f7;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Login form container */
        .login-form {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 380px;
        }

        /* Title styling */
        .login-form h1 {
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: 600;
            color: #333;
        }

        /* Input field styling */
        .login-form input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #d1d1d6;
            font-size: 16px;
            background-color: #f9f9f9;
            box-sizing: border-box;
            transition: background-color 0.3s, border-color 0.3s;
        }

        /* Input focus state */
        .login-form input:focus {
            background-color: #eaeaea;
            border-color: #0071e3;
            outline: none;
        }

        /* Button styling */
        .login-form button {
            width: 100%;
            padding: 12px;
            background-color: #0071e3;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        /* Button hover state */
        .login-form button:hover {
            background-color: #005bb5;
        }

        /* Additional text styling */
        .login-form p {
            margin-top: 15px;
            color: #555;
            font-size: 14px;
        }

        /* Links styling */
        .login-form a {
            color: #0071e3;
            text-decoration: none;
        }

        .login-form a:hover {
            text-decoration: underline;
        }

        /* Error message styling */
        .error-message {
            color: #ff3b30;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <!-- Form untuk login -->
        <form action="" method="post">  
            <h1>Login</h1>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>

            <!-- Pesan kesalahan jika ada -->
            <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
            <!-- Link ke halaman register -->
            <p>Don't have an account? <a href="index.php?action=register">Register here</a></p>
        </form>
         
    </div>
</body>
</html>
