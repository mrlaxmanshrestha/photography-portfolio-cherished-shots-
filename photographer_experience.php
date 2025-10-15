<?php
$conn = mysqli_connect("localhost", "root", "", "cherished_shots");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM photographers";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Photographers</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      color: #333;
      background-color: #f9f9f9;
    }
    
    main {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 20px;
    }
    
    .photographer-container {
      margin: 20px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 500px;
    }
    
    .photographer-container img {
      width: 100%;
      height: 300px;
      object-fit: cover;
      border-radius: 10px 10px 0 0;
    }
    
    .photographer-container h2 {
      margin-top: 0;
    }
    
    .photographer-container ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .photographer-container li {
      margin-bottom: 10px;
    }
    
    .photographer-container li:before {
      content: "\2022";
      margin-right: 10px;
      color: #666;
    }
  </style>
</head>
<body>
  <main>
    <?php
    while ($photographer = mysqli_fetch_assoc($result)) {
        ?>
        <section class="photographer-container">
          <img src="<?php echo $photographer['photographer_image']; ?>" alt="<?php echo $photographer['photographer_name']; ?>">
          <h2><?php echo $photographer['photographer_name']; ?></h2>
          <ul>
            <li><?php echo $photographer['photographer_experience']; ?></li>
          </ul>
        </section>
        <?php
    }
    ?>
  </main>

  <?php
  mysqli_close($conn);
  ?>
</body>
</html>