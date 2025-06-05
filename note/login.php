<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $hashed);
    if ($stmt->fetch() && password_verify($password, $hashed)) {
        $_SESSION["user_id"] = $id;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        /* Navbar styles */
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0; padding: 0;
        }
        .navbar {
            background-color: #007bff;
            overflow: hidden;
            padding: 15px 30px;
        }
        .navbar a {
            float: left;
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            font-size: 17px;
            transition: background-color 0.3s;
            border-radius: 4px;
        }
        .navbar a:hover {
            background-color: #0056b3;
        }

        /* Form styles */
        form {
            background: #fff;
            padding: 20px;
            width: 320px;
            margin: 50px auto;
            box-shadow: 0 0 10px #ccc;
            border-radius: 6px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
		.h2{
			text-align: center;
			font-family: Times New Roman;
			
		}
		.a{
			text-align: center;
		}
    </style>
</head>
<body>

    <div class="navbar">
        <a href="index.php">Home</a>
       
    </div>

    <form method="post" action="">
        <h2 class="h2">Login</h2>

        <?php if (isset($error)) { echo "<div class='error'>{$error}</div>"; } ?>

        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
		<div class="a">
		<a href="register.php">Don't have account ? Sign up  </a>
		</div>
    </form>

</body>
</html>
