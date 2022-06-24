    <!-- Sidebar -->
    <div class="header-slider-background  w3-bar-block" style="display:none;z-index:5" id="mySidebar">
        <br><br>
        <a href="#" class="slider_link">Link 1</a><br><br>
        <a href="#" class="slider_link">Link 1</a><br><br>
        <a href="#" class="slider_link">Link 1</a><br><br>
        <a href="#" class="slider_link">Link 1</a><br><br>
        <a href="#" class="slider_link">Link 1</a><br><br>
        
    </div>
    <div class="w3-overlay" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

    
        <header class="row">
            
                <div class="">
                    <img src="./img/logo/logo.png" alt="" class="header_logo">
                </div>
                <div class="hide_in_mobile">
                    <a href="#" class="header-text">BROWSER</a>
                    <a href="#" class="header-text">CHAT</a>
                    <a href="#" class="header-text">COMMUNITY</a>
                </div>
                <div class="hide_in_mobile">
                    <a href="#"><i class="material-icons b-googleicon">sms</i></a>
                    <a href="#"><i class="material-icons b-googleicon">notifications_none</i></a>
                    <a href="#"><i class="material-icons b-googleicon" style="margin-right: 10px;">person</i></a>
                    <button  onclick="w3_open()" class="left-slidebar">&#9776;</button>
                </div>
                <div class="hide_in_pc">
                  <button  onclick="w3_open()" class="left-slidebar">&#9776;</button>
              </div>
            
        </header>
        <!---Header script-->
        <script>
            function w3_open() {
              document.getElementById("mySidebar").style.display = "block";
              document.getElementById("myOverlay").style.display = "block";
            }
            
            function w3_close() {
              document.getElementById("mySidebar").style.display = "none";
              document.getElementById("myOverlay").style.display = "none";
            }
        </script>


        <!--js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="./css/w3.css">
    