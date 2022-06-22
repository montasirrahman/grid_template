<?php
include('db.php');
$msg="";
if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	
	$check=mysqli_num_rows(mysqli_query($con,"select * from user where email='$email'"));
	
	if($check>0){
		$msg="Email id already present";
	}else{
		$verification_id=rand(111111111,999999999);
		
		mysqli_query($con,"insert into user(name,email,password,verification_status,verification_id) values('$name','$email','$password',0,'$verification_id')");
		
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

function smtp_mailer($to,$subject, $msg){
	require_once("smtp/class.phpmailer.php");
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPDebug = 1; 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "unfridaygroup@gmail.com";
	$mail->Password = "bqdikvsrxwpswwch";
	$mail->SetFrom("no-replay@lifestylesutopia.com");
	$mail->From = "Utsho";
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		return 0;
	}else{
		return 1;
	}
}
?>


<html lang="en">
<head>

</head>
<body>
<div class="signup-form">
    <form method="post">
		<h2>Register</h2>
		<p class="hint-text">Create your account. It's free and only takes a minute.</p>
         <div class="form-group">
        	<input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div>
		
		<div class="form-group">
            <button type="submit"  name="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
		<div class="message">
		<?php
		echo $msg;
		?>
		</div>
    </form>
	<div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>
</div>
</body>
</html>                            