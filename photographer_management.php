<?php
$conn = mysqli_connect("localhost", "root", "", "cherished_shots");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $photographer_image = $_POST['Photographer_image'];
            $photographer_name = $_POST['photographer_name'];
            $photographer_experience = $_POST['photographer_experience'];

            $query = "INSERT INTO photographers (photographer_image, photographer_name, photographer_experience) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sss", $photographer_image, $photographer_name, $photographer_experience);
            if (mysqli_stmt_execute($stmt)) {
                echo "Photographer added successfully!";
            } else {
                echo "Error adding photographer: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
            exit;
        }

        if ($_POST['action'] == 'delete') {
            $id = $_POST['id'];
            $query = "DELETE FROM photographers WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                echo "Photographer deleted successfully!";
            } else {
                echo "Error deleting photographer: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
            exit;
        }

        if ($_POST['action'] == 'update') {
            $id = $_POST['id'];
            $photographer_image = $_POST['Photographer_image'];
            $photographer_name = $_POST['photographer_name'];
            $photographer_experience = $_POST['photographer_experience'];

            $query = "UPDATE photographers SET photographer_image = ?, photographer_name = ?, photographer_experience = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sssi", $photographer_image, $photographer_name, $photographer_experience, $id);
            if (mysqli_stmt_execute($stmt)) {
                echo "Photographer updated successfully!";
            } else {
                echo "Error updating photographer: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
            exit;
        }
    }
}

$query = "SELECT * FROM photographers";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photographer Management</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 20px;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
}

h2 {
    color: #333;
    font-size: 1.8rem;
    border-bottom: 2px solid #333;
    text-align: center;
    margin-bottom: 20px;
}

form {
    width: 40%;
    margin: 0 auto 20px auto;
    padding: 15px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 5%;

}

input[type="text"], textarea {
    width: 100%;
    padding: 8px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #333;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

th, td {
    padding: 15px;
    text-align: center;
    border: 1px solid #ddd;
}

th {
    background-color: #333;
    color: white;
}

td {
    background-color: #f9f9f9;
}

textarea {
    resize: vertical;
    height: 120px;
}

@media (max-width: 768px) {
    table, th, td {
        display: block;
        width: 100%;
        text-align: left;
    }

    th, td {
        padding: 10px;
    }

    input[type="submit"] {
        width: 100%;
        padding: 12px;
    }

    form {
        padding: 10px;
    }
}

    </style>
</head>
<body>
    <h2>Add a New Photographer</h2>
    <form id="add-photographer-form">
        <label for="Photographer_image">Photographer Image Link:</label>
        <input type="text" id="Photographer_image" name="Photographer_image" required><br><br>
        <label for="photographer_name">Photographer Name:</label>
        <input type="text" id="photographer_name" name="photographer_name" required><br><br>
        <label for="photographer_experience">Photographer Experience:</label>
        <textarea id="photographer_experience" name="photographer_experience" required></textarea><br><br>
        <input type="submit" value="Add">
    </form>

    <h2>Existing Photographers</h2>
    <table border='2' width='800px' align='center'>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Experience</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($photographer = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td align='center'>
                    <input type="hidden" name="id" value="<?php echo $photographer['id']; ?>">
                    <input type="text" name="Photographer_image" value="<?php echo $photographer['photographer_image']; ?>" required>
                </td>
                <td align='center'>
                    <input type="text" name="photographer_name" value="<?php echo $photographer['photographer_name']; ?>" required>
                </td>
                <td align='center'>
                    <textarea name="photographer_experience" required><?php echo $photographer['photographer_experience']; ?></textarea>
                </td>
                <td align='center'>
                    <button onclick="updatePhotographer(<?php echo $photographer['id']; ?>)">Update</button>
                    <button onclick="deletePhotographer(<?php echo $photographer['id']; ?>)">Delete</button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <script>
        document.getElementById('add-photographer-form').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            formData.append('action', 'add');

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'photographer_management.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                    location.reload();
                } else {
                    alert('An error occurred while adding the photographer.');
                }
            };
            xhr.send(formData);
        });

        function updatePhotographer(id) {
            var row = event.target.closest('tr');
            var formData = new FormData();
            formData.append('action', 'update');
            formData.append('id', id);
            formData.append('Photographer_image', row.querySelector('input[name="Photographer_image"]').value);
            formData.append('photographer_name', row.querySelector('input[name="photographer_name"]').value);
            formData.append('photographer_experience', row.querySelector('textarea[name="photographer_experience"]').value);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'photographer_management.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                    location.reload();
                } else {
                    alert('An error occurred while updating the photographer.');
                }
            };
            xhr.send(formData);
        }

        function deletePhotographer(id) {
            if (confirm('Are you sure you want to delete this photographer?')) {
                var formData = new FormData();
                formData.append('action', 'delete');
                formData.append('id', id);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'photographer_management.php', true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                        location.reload();
                    } else {
                        alert('An error occurred while deleting the photographer.');
                    }
                };
                xhr.send(formData);
            }
        }
    </script>
</body>
</html>
