<?php
    error_reporting(0);
    error_reporting(error_reporting() & ~E_NOTICE);
?>
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
				<a href='https://lifestylesutopia.com/0/check.php?id=$verification_id' style='color:#fff;font-family: 'Open Sans',Arial,Helvetica,sans-serif;font-size: 22px;background-color: #fd7801;text-decoration:none;padding: 10px 28px;border-radius: 4px;'>Verify</a>
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
	$mail->SetFrom('donotreply@mydomain.com', 'Lifestylesutopia');
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



$home_email = $_POST['email'];
$home_password = $_POST['password'];
$home_catagory = $_POST['catagory'];
?>


<html>
<head>
    <?php include './include/meta.php';?>
    <title>Join</title>
    <link rel="stylesheet" href="./css/user/reg.css">
</head>
<body>
    <div class="grid-container">
        <?php include './include/header.php';?>
        <main>
            <?php include './part/reg.php'; ?>
            <div class="reg_cointainer">
                <form method="post" class="register_form">

                    <h2 class="create_your_account">CREATE YOUR ACCOUNT</h2>

                    <div class="message">
                        <?php
                        echo $msg;
                        ?>
                    </div>

                    <div class="form-group">
                        <p for="">Full Name : </p>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Full Name"   required>
                    </div>
                    <div class="form-group">
                        <p for="">Username : </p>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <p for="">Email : </p>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $home_email; ?>" required>
                    </div>
                    <div class="form-group">
                        <p for="">password : </p>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $home_password; ?>" required>
                    </div>
                    <div class="form-group" style="display: none">
                        <p for="">Category : </p>
                        <input type="text" class="form-control" name="category" id="category" placeholder="category" value="<?php echo $home_catagory; ?>" >
                    </div>
                    <div class="form-group">
                        <p for="">Date of Birth : </p>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Date of birth" required>
                    </div>


                    <!--if start--->

                    <?php
                    $word = $home_catagory;
                    $mystring = "mf mm ff";
                    
                    // Test if string contains the word 
                    if(strpos($mystring, $word) !== false){
                        echo '
                            <div class="form-group">
                                <p for="">Partner 1 : </p>
                                <input type="text" class="form-control" name="p1" id="p1" placeholder="Partner 1" required>
                            </div>
                            <div class="form-group">
                                <p for="">Date  of birth : </p>
                                <input type="date" class="form-control" name="p1_date_of_birth" id="p1_date_of_birth" placeholder="Date of birth" required>
                            </div>
                            <div class="form-group">
                                <p for="">Partner 2 : </p>
                                <input type="text" class="form-control" name="p2" id="p2" placeholder="Partner 2" required>
                            </div>
                            <div class="form-group">
                                <p for="">Date  of birth : </p>
                                <input type="date" class="form-control" name="p2_date_of_birth" id="p2_date_of_birth" placeholder="Date  of birth" required>
                            </div>	
                        ';
                    } else{
                        echo '
                            <div class="form-group single">
                                <lable for="">Single : </lable>
                                <input type="checkbox" class="form-control-box" name="single" id="single" placeholder="single" value="1">
                            </div>
                        ';
                    }
                    ?>



                    <!---Country--->
                    <div class="form-group custom-select">
                        <p for="">Country : </p>
                        <select id="country" name="country" required>
                            <option>select country</option>
                            <option value="AF">Afghanistan</option>
                            <option value="AX">Aland Islands</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="AS">American Samoa</option>
                            <option value="AD">Andorra</option>
                            <option value="AO">Angola</option>
                            <option value="AI">Anguilla</option>
                            <option value="AQ">Antarctica</option>
                            <option value="AG">Antigua and Barbuda</option>
                            <option value="AR">Argentina</option>
                            <option value="AM">Armenia</option>
                            <option value="AW">Aruba</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="AZ">Azerbaijan</option>
                            <option value="BS">Bahamas</option>
                            <option value="BH">Bahrain</option>
                            <option value="BD">Bangladesh</option>
                            <option value="BB">Barbados</option>
                            <option value="BY">Belarus</option>
                            <option value="BE">Belgium</option>
                            <option value="BZ">Belize</option>
                            <option value="BJ">Benin</option>
                            <option value="BM">Bermuda</option>
                            <option value="BT">Bhutan</option>
                            <option value="BO">Bolivia</option>
                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                            <option value="BA">Bosnia and Herzegovina</option>
                            <option value="BW">Botswana</option>
                            <option value="BV">Bouvet Island</option>
                            <option value="BR">Brazil</option>
                            <option value="IO">British Indian Ocean Territory</option>
                            <option value="BN">Brunei Darussalam</option>
                            <option value="BG">Bulgaria</option>
                            <option value="BF">Burkina Faso</option>
                            <option value="BI">Burundi</option>
                            <option value="KH">Cambodia</option>
                            <option value="CM">Cameroon</option>
                            <option value="CA">Canada</option>
                            <option value="CV">Cape Verde</option>
                            <option value="KY">Cayman Islands</option>
                            <option value="CF">Central African Republic</option>
                            <option value="TD">Chad</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CX">Christmas Island</option>
                            <option value="CC">Cocos (Keeling) Islands</option>
                            <option value="CO">Colombia</option>
                            <option value="KM">Comoros</option>
                            <option value="CG">Congo</option>
                            <option value="CD">Congo, Democratic Republic of the Congo</option>
                            <option value="CK">Cook Islands</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Cote D'Ivoire</option>
                            <option value="HR">Croatia</option>
                            <option value="CU">Cuba</option>
                            <option value="CW">Curacao</option>
                            <option value="CY">Cyprus</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="DK">Denmark</option>
                            <option value="DJ">Djibouti</option>
                            <option value="DM">Dominica</option>
                            <option value="DO">Dominican Republic</option>
                            <option value="EC">Ecuador</option>
                            <option value="EG">Egypt</option>
                            <option value="SV">El Salvador</option>
                            <option value="GQ">Equatorial Guinea</option>
                            <option value="ER">Eritrea</option>
                            <option value="EE">Estonia</option>
                            <option value="ET">Ethiopia</option>
                            <option value="FK">Falkland Islands (Malvinas)</option>
                            <option value="FO">Faroe Islands</option>
                            <option value="FJ">Fiji</option>
                            <option value="FI">Finland</option>
                            <option value="FR">France</option>
                            <option value="GF">French Guiana</option>
                            <option value="PF">French Polynesia</option>
                            <option value="TF">French Southern Territories</option>
                            <option value="GA">Gabon</option>
                            <option value="GM">Gambia</option>
                            <option value="GE">Georgia</option>
                            <option value="DE">Germany</option>
                            <option value="GH">Ghana</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GR">Greece</option>
                            <option value="GL">Greenland</option>
                            <option value="GD">Grenada</option>
                            <option value="GP">Guadeloupe</option>
                            <option value="GU">Guam</option>
                            <option value="GT">Guatemala</option>
                            <option value="GG">Guernsey</option>
                            <option value="GN">Guinea</option>
                            <option value="GW">Guinea-Bissau</option>
                            <option value="GY">Guyana</option>
                            <option value="HT">Haiti</option>
                            <option value="HM">Heard Island and Mcdonald Islands</option>
                            <option value="VA">Holy See (Vatican City State)</option>
                            <option value="HN">Honduras</option>
                            <option value="HK">Hong Kong</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IR">Iran, Islamic Republic of</option>
                            <option value="IQ">Iraq</option>
                            <option value="IE">Ireland</option>
                            <option value="IM">Isle of Man</option>
                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="JE">Jersey</option>
                            <option value="JO">Jordan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KE">Kenya</option>
                            <option value="KI">Kiribati</option>
                            <option value="KP">Korea, Democratic People's Republic of</option>
                            <option value="KR">Korea, Republic of</option>
                            <option value="XK">Kosovo</option>
                            <option value="KW">Kuwait</option>
                            <option value="KG">Kyrgyzstan</option>
                            <option value="LA">Lao People's Democratic Republic</option>
                            <option value="LV">Latvia</option>
                            <option value="LB">Lebanon</option>
                            <option value="LS">Lesotho</option>
                            <option value="LR">Liberia</option>
                            <option value="LY">Libyan Arab Jamahiriya</option>
                            <option value="LI">Liechtenstein</option>
                            <option value="LT">Lithuania</option>
                            <option value="LU">Luxembourg</option>
                            <option value="MO">Macao</option>
                            <option value="MK">Macedonia, the Former Yugoslav Republic of</option>
                            <option value="MG">Madagascar</option>
                            <option value="MW">Malawi</option>
                            <option value="MY">Malaysia</option>
                            <option value="MV">Maldives</option>
                            <option value="ML">Mali</option>
                            <option value="MT">Malta</option>
                            <option value="MH">Marshall Islands</option>
                            <option value="MQ">Martinique</option>
                            <option value="MR">Mauritania</option>
                            <option value="MU">Mauritius</option>
                            <option value="YT">Mayotte</option>
                            <option value="MX">Mexico</option>
                            <option value="FM">Micronesia, Federated States of</option>
                            <option value="MD">Moldova, Republic of</option>
                            <option value="MC">Monaco</option>
                            <option value="MN">Mongolia</option>
                            <option value="ME">Montenegro</option>
                            <option value="MS">Montserrat</option>
                            <option value="MA">Morocco</option>
                            <option value="MZ">Mozambique</option>
                            <option value="MM">Myanmar</option>
                            <option value="NA">Namibia</option>
                            <option value="NR">Nauru</option>
                            <option value="NP">Nepal</option>
                            <option value="NL">Netherlands</option>
                            <option value="AN">Netherlands Antilles</option>
                            <option value="NC">New Caledonia</option>
                            <option value="NZ">New Zealand</option>
                            <option value="NI">Nicaragua</option>
                            <option value="NE">Niger</option>
                            <option value="NG">Nigeria</option>
                            <option value="NU">Niue</option>
                            <option value="NF">Norfolk Island</option>
                            <option value="MP">Northern Mariana Islands</option>
                            <option value="NO">Norway</option>
                            <option value="OM">Oman</option>
                            <option value="PK">Pakistan</option>
                            <option value="PW">Palau</option>
                            <option value="PS">Palestinian Territory, Occupied</option>
                            <option value="PA">Panama</option>
                            <option value="PG">Papua New Guinea</option>
                            <option value="PY">Paraguay</option>
                            <option value="PE">Peru</option>
                            <option value="PH">Philippines</option>
                            <option value="PN">Pitcairn</option>
                            <option value="PL">Poland</option>
                            <option value="PT">Portugal</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="QA">Qatar</option>
                            <option value="RE">Reunion</option>
                            <option value="RO">Romania</option>
                            <option value="RU">Russian Federation</option>
                            <option value="RW">Rwanda</option>
                            <option value="BL">Saint Barthelemy</option>
                            <option value="SH">Saint Helena</option>
                            <option value="KN">Saint Kitts and Nevis</option>
                            <option value="LC">Saint Lucia</option>
                            <option value="MF">Saint Martin</option>
                            <option value="PM">Saint Pierre and Miquelon</option>
                            <option value="VC">Saint Vincent and the Grenadines</option>
                            <option value="WS">Samoa</option>
                            <option value="SM">San Marino</option>
                            <option value="ST">Sao Tome and Principe</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="SN">Senegal</option>
                            <option value="RS">Serbia</option>
                            <option value="CS">Serbia and Montenegro</option>
                            <option value="SC">Seychelles</option>
                            <option value="SL">Sierra Leone</option>
                            <option value="SG">Singapore</option>
                            <option value="SX">Sint Maarten</option>
                            <option value="SK">Slovakia</option>
                            <option value="SI">Slovenia</option>
                            <option value="SB">Solomon Islands</option>
                            <option value="SO">Somalia</option>
                            <option value="ZA">South Africa</option>
                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                            <option value="SS">South Sudan</option>
                            <option value="ES">Spain</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="SD">Sudan</option>
                            <option value="SR">Suriname</option>
                            <option value="SJ">Svalbard and Jan Mayen</option>
                            <option value="SZ">Swaziland</option>
                            <option value="SE">Sweden</option>
                            <option value="CH">Switzerland</option>
                            <option value="SY">Syrian Arab Republic</option>
                            <option value="TW">Taiwan, Province of China</option>
                            <option value="TJ">Tajikistan</option>
                            <option value="TZ">Tanzania, United Republic of</option>
                            <option value="TH">Thailand</option>
                            <option value="TL">Timor-Leste</option>
                            <option value="TG">Togo</option>
                            <option value="TK">Tokelau</option>
                            <option value="TO">Tonga</option>
                            <option value="TT">Trinidad and Tobago</option>
                            <option value="TN">Tunisia</option>
                            <option value="TR">Turkey</option>
                            <option value="TM">Turkmenistan</option>
                            <option value="TC">Turks and Caicos Islands</option>
                            <option value="TV">Tuvalu</option>
                            <option value="UG">Uganda</option>
                            <option value="UA">Ukraine</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="GB">United Kingdom</option>
                            <option value="US">United States</option>
                            <option value="UM">United States Minor Outlying Islands</option>
                            <option value="UY">Uruguay</option>
                            <option value="UZ">Uzbekistan</option>
                            <option value="VU">Vanuatu</option>
                            <option value="VE">Venezuela</option>
                            <option value="VN">Viet Nam</option>
                            <option value="VG">Virgin Islands, British</option>
                            <option value="VI">Virgin Islands, U.s.</option>
                            <option value="WF">Wallis and Futuna</option>
                            <option value="EH">Western Sahara</option>
                            <option value="YE">Yemen</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabwe</option>
                        </select>
                        
                    </div>

                    

                    <div class="form-group">
                        <p for="">City : </p>
                        <input type="text" class="form-control" name="city" id="city" placeholder="City" required>
                    </div>

                    <!---Check box--->
                    <div class="form-group box_radio">
                        <p for="">Interested in : </p>
                        <input type="radio" class="form-control-box" name="interested" id="interested" placeholder="interested" value="male"><span> Male </span> 
                        <input type="radio" class="form-control-box" name="interested" id="interested" placeholder="interested" value="female"><span> Female </span>   
                        <input type="radio" class="form-control-box" name="interested" id="interested" placeholder="interested" value="mf"><span> Couple </span>   
                        <input type="radio" class="form-control-box" name="interested" id="interested" placeholder="interested" value="mm"><span> Male Couple </span>   
                        <input type="radio" class="form-control-box" name="interested" id="interested" placeholder="interested" value="ff"><span> Female Couple </span>   
                        <input type="radio" class="form-control-box" name="interested" id="interested" placeholder="interested" value="tv"><span> TV/TS/CD </span>   
                    </div>
                    <div class="form-group box box_radio">
                        <p for="">Looking for : </p>
                        <input type="radio" class="form-control-box" name="lookingfor" id="lookingfor" placeholder="lookingfor" value="friends"><span> Friends </span>  
                        <input type="radio" class="form-control-box" name="lookingfor" id="lookingfor" placeholder="lookingfor" value="event"><span> Events & Places  </span> 
                    </div>
                    



                    <!---Button---->
                    <div class="form-group">
                        <button type="submit"  name="submit" class="sub-btn">JOIN</button>
                    </div>
                </form>
                <div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>
            </div>
        </main>
        <?php include './include/footer.php';?>
    </div>
</body>
</html>