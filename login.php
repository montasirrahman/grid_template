<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<div class="signup-form">
    <form method="post">
		<h2>Login</h2>
		<p class="hint-text">Enter your email id and password.</p>
         
        <div class="form-group">
        	<input type="email" class="form-control" name="email" id="email" placeholder="Email">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
		
		<div class="form-group">
            <button type="button" class="btn btn-success btn-lg btn-block" onclick="login_now()">Login Now</button>
        </div>
		<div class="message"></div>
    </form>
	<div class="text-center">Create a account? <a href="registration.php">Sign up</a></div>
</div>
<script>
function login_now(){
	var email=jQuery('#email').val();
	var password=jQuery('#password').val();
	
	jQuery.ajax({
		url:'login_check.php',
		type:'post',
		data:'email='+email+'&password='+password,
		success:function(result){
			if(result=='done'){
				window.location.href='dashboard.php';
			}
			jQuery('.message').html(result);
		}
	});
}
</script>
</body>
</html>                            