<?php
include('./database/db.php');
$id=mysqli_real_escape_string($con,$_GET['id']);
mysqli_query($con,"update users set verification_status='1' where verification_id='$id'");
echo "Your account verified";
?>
<a href="login.php"> Click here for Login<a/>
