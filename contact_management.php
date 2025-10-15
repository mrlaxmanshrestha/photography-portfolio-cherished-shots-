<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'cherished_shots';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['attended'])) {
    $id = $_POST['id'];
    $attended = $_POST['attended'];

    $update_sql = "UPDATE contact_requests SET attended = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);

    if ($stmt) {
        $stmt->bind_param('si', $attended, $id);

        if ($stmt->execute()) {
            echo "Update successful";
        } else {
            echo "Update failed: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to prepare statement: " . $conn->error;
    }

    $conn->close();
    exit();
}

$sql = "SELECT * FROM contact_requests";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management</title>
    <style>
        .centered {
            margin: 0 auto;
            margin-top: 20px;
        }
        body {
            background-color: #f4f4f9;
        }
    </style>
</head>
<body>

<h2 style="text-align: center; font-weight: bold">Contact/Booking Management</h2>
<table border="2" class="centered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Purpose</th>
        <th>Message</th>
        <th>Attended</th>
        <th>Action</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["purpose"] . "</td>";
            echo "<td>" . $row["message"] . "</td>";
            echo "<td>" . $row["attended"] . "</td>";
            echo "<td>
                    <select onchange=\"updateAttended(" . $row["id"] . ", this.value)\">
                        <option value='No'" . ($row["attended"] == 'No' ? ' selected' : '') . ">No</option>
                        <option value='Yes'" . ($row["attended"] == 'Yes' ? ' selected' : '') . ">Yes</option>
                    </select>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No requests found</td></tr>";
    }
    ?>
</table>

<script>
    function updateAttended(id, attended) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'contact_management.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                alert(xhr.responseText);
                window.location.href = 'admin_panel.php?click=contact_management';
            } else {
                alert('An error occurred during the update.');
            }
        };
        xhr.send('id=' + encodeURIComponent(id) + '&attended=' + encodeURIComponent(attended));
    }
</script>

</body>
</html>

<?php
$conn->close();
?>
