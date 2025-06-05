<?php
session_start();
include "config.php";
$id = $_GET['id'];
$user_id = $_SESSION["user_id"];
$conn->query("DELETE FROM notes WHERE id=$id AND user_id=$user_id");
header("Location: dashboard.php");
