<?php
include "config.php";

$showSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $error = "Email already registered.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);
        if ($stmt->execute()) {
            $showSuccess = true;
        } else {
            $error = "Something went wrong.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 50px; }
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
        .error { color: red;
		text-align: center;
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
		 body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0; padding: 0;
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
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    
    <form method="post">
        <h2 class="h2">Register</h2>
        <input name="email" type="email" placeholder="Email" required>
        <input name="password" type="password" placeholder="Password" required>
        <button type="submit">Register</button>
		<div class="a">
		<a href="login.php">Already have an account? </a>
		</div>
    </form>

    <?php if ($showSuccess): ?>
        <script>
            alert("Registration Successful!");
            window.location.href = "login.php";
        </script>
    <?php endif; ?>
</body>
</html>
