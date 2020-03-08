<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>L O G I N</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/login.css">
<script type="text/javascript" src="./js/login.js"></script>
</head>
<body>
	<header>
    	<?php include "header.php";?>
    </header>
	<section>
		<div id="main_img_bar">
            <img src="./img/mainCenterImg.jpg">
        </div>
        <div id="main_content">
      		<div id="login_box">
	    		<div id="login_title">
						<span>L O G I N</span>
	    		</div>
	    		<div id="login_form">
          		<form  name="login_form" method="post" action="login.php">
                  	<ul>
                    <li><input type="text" name="uid" id="uid" placeholder="아이디" ></li>
                    <li><input type="password" name="upw"  id="upw" placeholder="비밀번호" ></li> <!-- pass -->
                  	</ul>
                  	<div id="login_btn">
                      	<a href="#"><img src="./img/login.jpg" width=200px height=53px onclick="check_input()"></a>
                  	</div>
           		</form>
        		</div> <!-- login_form -->
    		</div> <!-- login_box -->
        </div> <!-- main_content -->
	</section>
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>
