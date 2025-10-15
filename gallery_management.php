<?php
$conn = mysqli_connect("localhost", "root", "", "cherished_shots");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle AJAX requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add' && isset($_FILES['image_file'])) {
            $image_name = $_POST['image_name'];
            $image_description = $_POST['image_description'];
            $image_file = $_FILES['image_file'];

            $uploads_dir = 'uploads';
            if (!is_dir($uploads_dir)) {
                mkdir($uploads_dir, 0777);
            }

            // Handle the uploaded file
            $image_link = $uploads_dir . '/' . basename($image_file['name']);
            move_uploaded_file($image_file['tmp_name'], $image_link);

            $query = "INSERT INTO gallery (image_name, image_description, image_link) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            if (!$stmt) {
                echo "Error preparing statement: " . mysqli_error($conn);
                exit;
            }
            mysqli_stmt_bind_param($stmt, "sss", $image_name, $image_description, $image_link);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error executing statement: " . mysqli_stmt_error($stmt);
                exit;
            }
            mysqli_stmt_close($stmt);

            echo "Image has been added to the gallery!";
            exit;
        }

        if ($_POST['action'] == 'delete' && isset($_POST['image_id'])) {
            $image_id = $_POST['image_id'];
            $query = "DELETE FROM gallery WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $image_id);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error executing statement: " . mysqli_stmt_error($stmt);
                exit;
            }
            mysqli_stmt_close($stmt);

            echo "Image has been deleted from the gallery!";
            exit;
        }
    }
}

$query = "SELECT * FROM gallery";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Error executing query: " . mysqli_error($conn);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Management</title>
    <style>
        body {
            background-color: #f4f4f9;
        }
        .gallery-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .gallery-image {
            width: 200px;
            height: 200px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .add-image-container {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 15px;
        }
        .add-image-container label {
            margin-bottom: 10px;
        }
        .add-image-container input[type="text"], 
        .add-image-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #333;
        }
        .add-image-container input[type="file"] {
            margin-bottom: 20px;
        }
        .add-image-container input[type="submit"] {
            background-color: #333;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .add-image-container input[type="submit"]:hover {
            background-color: #333;
        }
        .gallery-table {
            width: 80%;
            background-color: #f0f0f0;
            text-align: center;
            font-size: 16px;
        }
        #imagestyle {
            width: 150px;
            height: 150px;
            margin: 20px auto;
        }
        .delete-container input[type="submit"] {
            background-color: #333;
            color: #ffffff;
        }
    </style>
</head>
<body>
<h2 align='center'>Add Images</h2>

<div class="add-image-container">
    <form id="add-image-form" enctype="multipart/form-data">
        <label for="image_name_input">Image Name:</label>
        <input type="text" id="image_name_input" name="image_name" required><br><br>
        <label for="image_description">Image Description:</label>
        <textarea id="image_description" name="image_description" required></textarea><br><br>
        <label for="image_file">Image File:</label>
        <input type="file" id="image_file" name="image_file" required><br><br>
        <input type="submit" value="Add Image">
    </form>
</div>

<h2 align='center'>Gallery Images</h2>
<table class="gallery-table" border='2' align='center'>
    <tr>
        <th>Image</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php while ($image = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><img id='imagestyle' src="<?php echo $image['image_link']; ?>" alt="<?php echo $image['image_name']; ?>"></td>
            <td><?php echo $image['image_description']; ?></td>
            <td>
                <button onclick="deleteImage(<?php echo $image['id']; ?>)">Delete</button>
            </td>
        </tr>
    <?php } ?>
</table>

<script>
    document.getElementById('add-image-form').addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        formData.append('action', 'add');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'gallery_management.php', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                alert(xhr.responseText);
                location.reload();
            } else {
                alert('An error occurred while adding the image.');
            }
        };
        xhr.send(formData);
    });

    function deleteImage(id) {
        if (confirm('Are you sure you want to delete this image?')) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'gallery_management.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                    location.reload();
                } else {
                    alert('An error occurred while deleting the image.');
                }
            };
            xhr.send('action=delete&image_id=' + encodeURIComponent(id));
        }
    }
</script>
</body>
</html>
