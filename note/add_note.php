<?php
session_start();
include "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $user_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $content);
    $stmt->execute();
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Note</title>
    <style>
         body { 
            font-family: Arial; 
            padding: 0; 
            margin: 0; 
            background: #f4f4f4; 
        }
        .navbar {
            background-color: #007bff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .navbar a:hover {
            background-color: #0056b3;
        }
        form {
            background: #fff;
            padding: 20px;
            width: 320px;
            margin: 50px auto;
            box-shadow: 0 0 10px #ccc;
            border-radius: 6px;
        }
        h2 {
            text-align: center;
            font-family: 'Times New Roman';
            margin-bottom: 20px;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        textarea {
            resize: vertical;
            min-height: 80px;
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
    </style>
</head>
<body>
<div class="navbar">
        <a href="dashboard.php">Dashboard</a>
		
        <a href="logout.php">Logout</a>
    </div>
    <form method="post">
        <h2 class="h2">Add New Note</h2>
        <input name="title" placeholder="Title" required>
        <textarea name="content" rows="4"cols="40" placeholder="Write your note..." required></textarea>
        <button type="submit">Save Note</button>
    </form>
</body>
</html>
