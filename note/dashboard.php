<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
include "config.php";

$user_id = $_SESSION["user_id"];
$notes = $conn->query("SELECT * FROM notes WHERE user_id = $user_id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f2f2f2;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #007bff;
            overflow: hidden;
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

        h2 {
            text-align: center;
            margin: 20px 0;
        }

        /* Pinterest Style Grid */
        .grid-container {
            column-count: 3;
            column-gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .note {
            background: #fff;
            display: inline-block;
            margin: 0 0 20px;
            width: 100%;
            box-sizing: border-box;
            padding: 15px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            break-inside: avoid;
        }

        .note strong {
            display: block;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .note p {
            white-space: pre-wrap;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .note a {
            font-size: 14px;
            color: #007bff;
            margin-right: 10px;
        }

        .note a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 1000px) {
            .grid-container {
                column-count: 2;
            }
        }
        @media (max-width: 600px) {
            .grid-container {
                column-count: 1;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="add_note.php">Add Note</a>
        </div>
        <div>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <h2>Your Notes</h2>

    <div class="grid-container">
        <?php while ($note = $notes->fetch_assoc()) { ?>
            <div class="note">
                <strong><?php echo htmlspecialchars($note['title']); ?></strong>
                <p><?php echo nl2br(htmlspecialchars($note['content'])); ?></p>
                <a href="edit_note.php?id=<?php echo $note['id']; ?>">Edit</a>
                <a href="delete_note.php?id=<?php echo $note['id']; ?>">Delete</a>
            </div>
        <?php } ?>
    </div>

</body>
</html>
