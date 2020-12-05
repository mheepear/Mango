<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="freehtml5.co" />

	<!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FreeHTML5.co
			
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	-->

	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
		<meta name="twitter:url" content="" />
		<meta name="twitter:card" content="" />

		<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
		
		<!-- Animate.css -->
		<link rel="stylesheet" href="css/animate.css">
		<!-- Icomoon Icon Fonts-->
		<link rel="stylesheet" href="css/icomoon.css">
		<!-- Bootstrap  -->
		<link rel="stylesheet" href="css/bootstrap.css">

		<!-- Theme style  -->
		<link rel="stylesheet" href="css/style.css">

		<!-- Modernizr JS -->
		<script src="js/modernizr-2.6.2.min.js"></script>
		<!-- FOR IE9 below -->
		<!--[if lt IE 9]>
		<script src="js/respond.min.js"></script>
		<![endif]-->

</head>

<body>
<div class="fh5co-loader"></div>
    <div id="page">	
    <header id="fh5co-header" class="fh5co-cover js-fullheight" role="banner" style="background-image:url(images/cover_bg_3.jpg);" data-stellar-background-ratio="0.5">
    
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t js-fullheight">
						<div class="display-tc js-fullheight animate-box" data-animate-effect="fadeIn">
                        <?php
                            include("connection.php");

                            if(isset($_POST['submit'])) {
                                $user = mysqli_real_escape_string($link, $_POST['username']);
                                $pass = mysqli_real_escape_string($link, $_POST['password']);

                                if($user == "" || $pass == "") {
                                    echo "Either username or password field is empty.";
                                    echo "<br/>";
                                    echo "<a href='login.php'>Go back</a>";
                                } else {
                                    $result = mysqli_query($link, "SELECT * FROM login WHERE username='$user' AND password=md5('$pass')")
                                                or die("Could not execute the select query.");
                                    
                                    $row = mysqli_fetch_assoc($result);
                                    
                                    if(is_array($row) && !empty($row)) {
                                        $validuser = $row['username'];
                                        $_SESSION['valid'] = $validuser;
                                        $_SESSION['name'] = $row['name'];
                                        $_SESSION['id'] = $row['id'];
                                    } else {
                                        echo "Invalid username or password.";
                                        echo "<br/>";
                                        echo "<a href='login.php'>Go back</a>";
                                    }

                                    if(isset($_SESSION['valid'])) {
                                        header('Location: index1.php');			
                                    }
                                }
                            } else {
                            ?>
                                <h2>Login</h2>
                                <form name="form1" method="post" action="">
                                    <table width="100%" border="0">
                                        <tr> 
                                            <td width="20%">Username</td>
                                            <td><input type="text" name="username"></td>
                                        </tr>
                                        <tr> 
                                            <td>Password</td>
                                            <td><input type="password" name="password"></td>
                                        </tr>
                                        <tr> 
                                            <td>&nbsp;</td>
                                            <td><input type="submit" name="submit" value="Submit"></td>
                                        </tr>
                                    </table>
                                </form>
                            <?php
                            }
                            ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up22"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Easy PieChart -->
	<script src="js/jquery.easypiechart.min.js"></script>
	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="js/google_map.js"></script>
	
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>