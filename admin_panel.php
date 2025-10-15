<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>
            alert('You are not logged in, please login first');
            window.location.href = 'index.php?click=login';
          </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style_admin.css">
</head>
<body>
   
<?php
include("sidebar_admin.php");
include("dashboard_admin.php");

if (isset($_GET['click'])) {
    $file = $_GET['click'] . ".php";
    if (file_exists($file) && is_file($file)) {
        include($file);
    }
} else {
    include("content.php");
}
?>

<?php
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']);
}
?>

</body>
</html>
