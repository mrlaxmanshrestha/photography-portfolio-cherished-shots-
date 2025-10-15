<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script>
    function loadContent(url, elementId) {
        fetch(url)
            .then(response => response.text())
            .then(data => document.getElementById(elementId).innerHTML = data)
            .catch(error => console.error('Error loading content:', error));
    }

    function confirmLogout(event) {
        event.preventDefault();
        if (confirm("Do you really want to log out?")) {
            window.location.href = "index.php?click=login";
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        loadContent('header.html', 'header');
        loadContent('footer.html', 'footer');

        document.querySelector('.logout').addEventListener('click', confirmLogout);
    });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<body>

<div class="sidebar">
  <center><img id='logoshape' src="logo.jpg" alt="Logo"></center>
  <a href="admin_panel.php" class="link-with-icon"><i class="fa fa-user"></i>Admin Panel</a>
  <a href="admin_panel.php?click=gallery_management" class="link-with-icon"><i class="fas fa-image"></i> Gallery Management</a>
  <a href="admin_panel.php?click=photographer_management" class="link-with-icon"><i class="fas fa-camera"></i> Photographer Management</a>
  <a href="admin_panel.php?click=about_us_management" class="link-with-icon"><i class="fas fa-building"></i> About Us Management</a>
  <a href="admin_panel.php?click=contact_management" class="link-with-icon"><i class="fas fa-phone"></i> Booking_management</a>
  <a href="logout.php" class="logout" class="link-with-icon"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<style>
   .link-with-icon {
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }

        .link-with-icon i {
            margin-right: 8px;
        }

.sidebar {
  width: 285px;
  height: 100vh;
  background-color: #ffffff;
  position: fixed;
  left: 0;
  top: 0;
  padding-top: 20px;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

.sidebar a {
  display: block;
  padding: 15px 20px;
  color: #333333;
  text-decoration: none;
  font-size: 18px;
  border-bottom: 1px solid #e0f7fa;
}

.sidebar a:hover {
  background-color: #e0f7fa;
}

.sidebar .logout {
  color: #red;
}

.sidebar .logout:hover {
  background-color: #red;
  color: #ffffff;
}
#logoshape{
  width: 100px;
  height: 100px;
  border-radius: 50%;
  object-fit: cover;
  display: flex; 
  justify-content: center; 
  align-items: center; 
  margin: 20px auto;
}
</style>

</body>
</html>