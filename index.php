<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cherished Shots Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<?php
include("heading.php");
if(isset($_GET['click'])){
    include($_GET['click'] . ".php");
} 
else{
include("mainpage.php");
}
include("footer.php");

?>

</body>
</html>