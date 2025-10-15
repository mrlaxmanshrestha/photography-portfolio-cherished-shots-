<?php
session_start();
ob_start();

$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'cherished_shots';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$query = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$query->bind_param('ss', $username, $password);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;

    header('Location: admin_panel.php');
    exit();
} else {
    header('Location: index.php?click=login&error=1');
    exit();
}

$conn->close();
?>
