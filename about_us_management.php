<?php
$conn = new mysqli("localhost", "root", "", "cherished_shots");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['company_logo']) && isset($_POST['company_name']) && isset($_POST['about_company'])) {
        $company_logo = $_POST['company_logo'];
        $company_name = $_POST['company_name'];
        $about_company = $_POST['about_company'];

        $query = "UPDATE about_us SET company_logo = ?, company_name = ?, about_company = ? WHERE id = 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $company_logo, $company_name, $about_company);
        if ($stmt->execute()) {
            echo "About Us updated successfully!";
        } else {
            echo "Error updating About Us: " . $stmt->error;
        }
        $stmt->close();
        exit;
    }
}

$query = "SELECT * FROM about_us";
$result = $conn->query($query);
$about_us = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update About Us</title>
    <style>
      body{
        background-color: #f4f4f9;
      }
      form {
        max-width: 500px;
        margin: 40px auto;
        padding: 20px;
        background-color: #ffffff;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5%;
      }

      label {
        display: block;
        margin-bottom: 10px;
      }

      input[type="text"], textarea {
        width: 96%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
      }

      input[type="submit"] {
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }

      input[type="submit"]:hover {
        background-color: #444;
      }

      textarea {
        height: 200px;
      }
    </style>
</head>
<body>
    <form id="update-about-us-form">
        <label for="company_logo">Company Logo:</label>
        <input type="text" id="company_logo" name="company_logo" value="<?php echo htmlspecialchars($about_us['company_logo']); ?>" required>

        <label for="company_name">Company Name:</label>
        <input type="text" id="company_name" name="company_name" value="<?php echo htmlspecialchars($about_us['company_name']); ?>" required>

        <label for="about_company">About Company:</label>
        <textarea id="about_company" name="about_company" required><?php echo htmlspecialchars($about_us['about_company']); ?></textarea>

        <input type="submit" value="Update About Us">
    </form>

    <script>
        document.getElementById('update-about-us-form').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_about_us.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                } else {
                    alert('An error occurred while updating About Us.');
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>
