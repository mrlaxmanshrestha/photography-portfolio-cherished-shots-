<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
    ?>
    <style>
        body {
                font-family: Arial, sans-serif;
                background-color: #e0f7fa;
                color: #333333;
                margin: 0;
                padding: 0;
            }
    
            .content {
                margin-left: 275px;
                padding: 20px;
            }
.header {

  background-color: white;
  padding: 20px;
  border-bottom: 1px solid #ccc;
  border-radius: 10px
}

.header > * {
  margin: 10px;
}

.header h1 {
  font-weight: bold;
  margin-top: 0;
}

.header p {
  font-size: 16px;
  color: #666;
}   
    </style>
    <div class="content">
        <div class="header">
            <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        </div>
</body>
</html>