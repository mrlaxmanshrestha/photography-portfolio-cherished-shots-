<?php
$conn = mysqli_connect("localhost", "root", "", "cherished_shots");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM about_us WHERE id = 1");

$about_usdatabase = mysqli_fetch_assoc($result);

if (isset($about_usdatabase)) {
    ?>
    <html>
        <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f0f0f0;
                }
                
                h1 {
                    color: #333;
                    margin-top: 40px;
                    text-align: center;
                }
                
                p {
                    color: #666;
                    margin: 20px 40px;
                    text-align: justify;
                }
                
                .social-media {
                    text-align: center;
                    margin-top: 40px;
                }
                
                .social-media a {
                    margin: 0 10px;
                    color: #666;
                    text-decoration: none;
                }
                
                .social-media a:hover {
                    color: #333;
                }

                .logo-image {
                    width: 150px;
                    height: 150px;
                    border-radius: 50%;
                    object-fit: cover;
                    display: flex; 
                    justify-content: center; 
                    align-items: center; 
                    margin: 20px auto;
}
            </style>
        </head>
        <body>
            <img src="<?php echo $about_usdatabase['company_logo']; ?>" alt="Logo" class="logo-image">
            <h1><?php echo $about_usdatabase['company_name']; ?></h1>
            <p><?php echo $about_usdatabase['about_company']; ?></p>
        </body>
        <div class="social-media">
                <a href="www.facebook.com/laxman2006"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="#" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
            </div>
    </html>
    <?php
} else {
    echo "No data found";
}

mysqli_close($conn);
?>