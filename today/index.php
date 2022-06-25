<html>
<head>
    <?php include './include/meta.php';?>
    <title>Lifestylesutopia</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <div class="grid-container">
        <?php include './include/header.php';?>
        <main>
            <!--main form-->
            <script>
                $(document).ready(function () {
                    $(".register-tab").click(function () {
                    $(".register-box").show();
                    $(".login-box").hide();
                    $(".register-tab").addClass("active");
                    $(".login-tab").removeClass("active");
                    });
                    $(".login-tab").click(function () {
                    $(".login-box").show();
                    $(".register-box").hide();
                    $(".login-tab").addClass("active");
                    $(".register-tab").removeClass("active");
                    });
                });
            </script>             
            <div class="home-image">
                <div class="row center">
                    <div class="main_img_hover_container">
                    </div>
                    <div class="login_reg">
                        <!-- Tab Buttons -->
                        <div id="tab-btn">
                          <a href="#" class="login-tab active">New here?</a>
                          <a href="#" class="register-tab">Sign In</a>
                        </div>
                        <!-- New User Form -->
                        <div class="login-box">
                          <h2 class="sign_text">Sign up is free of charge, non-binding, and doesn't commit you to anything.</h2>
                          <form action="join.php" method="POST" id="login-form">
                            <input type="email" name="email" placeholder="Enter Email" class="inp" required /><br />
                            <input type="password" name="password" placeholder="Password" class="inp" required /><br />
                            <!--select-->
							              <select name="catagory" class="home_select" required>
                                <option value="">I am..</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="mf">Couple</option>
                                <option value="mm">Male Couple</option>
                                <option value="ff">Female Couple</option>
                                <option value="tv">TV/TS/CD</option>
                            </select>
                              <br /><br />
                            <input type="submit" value="LET'S GO!" class="sub-btn" />
                          </form>
                        </div>
                        <!-- login Form -->
                        <div class="register-box">
                            <h2 class="sign_text">Enter your username/email and password to login.</h2>
                            <form action="#" method="post" id="login-form">
                              <input type="email" name="email" placeholder="Enter Email or Username" class="inp" required /><br />
                              <input type="password" name="password" placeholder="Password" class="inp" required /><br />
                              <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                              <label class="remember_me_text"> Remember Me</label><br/><br/>
                              <input type="submit" name="submit" value="SIGN IN" class="sub-btn" />
                          </form>
                        </div>
                      </div>
                </div>
            </div>           
        </main>
        <?php include './include/footer.php';?>
    </div>
</body>
</html>