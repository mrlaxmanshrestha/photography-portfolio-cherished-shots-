<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'cherished_shots';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];
  $purpose = $_POST["purpose"];


  $sql = "INSERT INTO contact_requests (name, email, purpose, message) VALUES ('$name', '$email', '$purpose', '$message')";
  if ($conn->query($sql) === TRUE) {
      echo "<script>alert('New record created successfully');</script>";
      echo "<script>window.location.href = 'index.php?click=contact';</script>";
      exit;
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
} 

$conn->close();
?>

<form action="contact.php" method="post">
  <label for="name">Name:</label>
  <input type="text" id="name" name="name" required><br><br>
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required><br><br>
  <label for="purpose">Purpose:</label>
  <select id="purpose" name="purpose" required>
    <option value="Inquiry">Inquiry</option>
    <option value="Booking">Booking</option>
    <option value="Collaboration">Collaboration</option>
  </select><br><br>
  <label for="message">Message:</label>
  <textarea id="message" name="message" required></textarea><br><br>
  <input type="submit" value="Send">
</form>

<style>
form {
  width:35%; 
  margin: 40px auto;
  padding: 20px;
  border: 1px solid #333;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  background-color: #f9f9f9;
}

label {
  display: block;
  margin-bottom: 10px;
  font-weight: bold;
  color: #333;
}

input[type="text"], input[type="email"], textarea {
  width: 96%;
  padding: 8px;
  margin-bottom: 20px;
  border: 1px solid #333;
  border-radius: 5px;
  background-color: #fff;
  transition: border-color 0.3s ease;
}

input[type="text"]:focus, input[type="email"]:focus, textarea:focus {
  border-color: #666; 
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

input[type="submit"] {
  background-color: #333; 
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease; 
}

input[type="submit"]:hover {
  background-color: #444; 
}


select {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #333;
  border-radius: 5px;
  background-color: #fff; 
}
</style>