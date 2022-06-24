<?php
include('./database/db.php');
$msg="";
if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$username=$_POST['username'];
	$category=$_POST['category'];
	$date_of_birth=$_POST['date_of_birth'];
	$single=$_POST['single'];
	$country=$_POST['country'];
	$city=$_POST['city'];
	$interested=$_POST['interested'];
	$lookingfor=$_POST['lookingfor'];
	$membership=$_POST['membership'];
	$p1=$_POST['p1'];
	$p1_date_of_birth=$_POST['p1_date_of_birth'];
	$p2=$_POST['p2'];
	$p2_date_of_birth=$_POST['p2_date_of_birth'];
	
	$check=mysqli_num_rows(mysqli_query($con,"select * from users where email='$email' OR username='$username'"));
	
	if($check>0){
		$msg="Email or Username is already present";
	}else{
		$verification_id=rand(111111111,999999999);
		
		mysqli_query($con,"insert into users(name,email,password,verification_status,verification_id,username,category,date_of_birth,single,country,city,interested,lookingfor,membership,p1,p1_date_of_birth,p2,p2_date_of_birth) values('$name','$email','$password',0,'$verification_id','$username','$category','$date_of_birth','$single','$country','$city','$interested','$lookingfor','$membership','$p1','$p1_date_of_birth','$p2','$p2_date_of_birth')");
	

		$msg="We've just sent a verification link to <strong>$email</strong>. Please check your inbox and click on the link to get started. If you can't find this email (which could be due to spam filters), just request a new one here.";
		
		

		$mailHtml="		
		<div style='width: 100%;height: 100%;padding:50px 0; margin:0;background-color: #F8F9FC;'>	
			<div style='max-width: 500px;width: 100%;display: block;margin: 0 auto;background-color: #fff;text-align:center;padding: 20px;'>
				<h2 style='text-align:center;width: 250px;display: block;margin: 0 auto;padding:25px 0;font-family: 'Open Sans',Arial,Helvetica,sans-serif;font-size: 30px;color: #000;font-weight: 600;background-color: #;'>Lifestylesutopia</h2>
				<h4 style='font-family: 'Open Sans',Arial,Helvetica,sans-serif;font-size: 18px;color: #263c51;margin: 25px 0 50px 0'>
					Please confirm your account registration
				</h4>
				<a href='https://lifestylesutopia.com/12/check.php?id=$verification_id' style='color:#fff;font-family: 'Open Sans',Arial,Helvetica,sans-serif;font-size: 22px;background-color: #fd7801;text-decoration:none;padding: 10px 28px;border-radius: 4px;'>Verify</a>
				<p style='padding: 8px;'></p>
			</div>
		</div>";
		
		
		smtp_mailer($email,'Account Verification',$mailHtml);
		
	}
}

include 'smtp.php';



$home_email = $_POST['email'];
$home_password = $_POST['password'];
$home_catagory = $_POST['catagory'];


?>