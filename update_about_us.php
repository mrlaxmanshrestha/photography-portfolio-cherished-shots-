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
        
        if ($stmt === false) {
            echo "Error preparing statement: " . $conn->error;
            exit;
        }

        $stmt->bind_param("sss", $company_logo, $company_name, $about_company);
        if ($stmt->execute()) {
            echo "About Us updated successfully!";
        } else {
            echo "Error updating About Us: " . $stmt->error;
        }
        
        $stmt->close();
        exit;
    } else {
        echo "Required data is missing.";
    }
}

$query = "SELECT * FROM about_us";
$result = $conn->query($query);
if ($result === false) {
    echo "Error fetching data: " . $conn->error;
    exit;
}
$about_us = $result->fetch_assoc();

echo json_encode($about_us);

$conn->close();
?>
