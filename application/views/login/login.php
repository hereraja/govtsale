<!DOCTYPE html>
<html lang="en">
<head>
	<title>Goverment Sale</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" href="<?php echo base_url("https://bkpczwccsl.com/hrms/assets/images/smb.jpg"); ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/vendor/bootstrap/css/bootstrap.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/vendor/animate/animate.css")?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/vendor/css-hamburgers/hamburgers.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/vendor/animsition/css/animsition.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/vendor/select2/select2.min.css")?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/vendor/daterangepicker/daterangepicker.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/css/util.css")?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/css/main.css")?>">
<!--===============================================================================================-->
<style>
	img {
	float: left;
	}
	p.title 
	{
		font: 15px arial, sans-serif;
	}
</style>
</head>
<body>
	<header class="headerTop">
		<div class="wrapper">
			<div class="col-sm-3 float-left logo"><img src="https://bkpczwccsl.com/hrms/assets/images/smb.jpg" alt="logo" style="height: 80px;width: 80px;"></div>
				<div class="col-sm-9 float-left topRightBar">
					<h2>BARRACKPORE CENTRAL ZONE WHOLESALE CONSUMERS' COOPERATIVE SOCIETY LIMITED</h2>
				
				</div>
			</div>	
		</div><br clear="all">
	</header>		
	<div class="bodyContainerLoginSocial">
		<div class="wrapper">
			<div class="loginBody">
				<form class="login100-form validate-form flex-sb flex-w"  id="login" method="POST" action="<?php echo site_url("User_Login") ?>">
					<div class="loginWraper">
						<div class="col_12Cus">
							<h3>Login</h3>
							<span class="confirm-div" style="float:right; color:green;"></span>
							
							<div class="form-group wrap-input100 validate-input m-b-36" data-validate = "Username is required">
							<input class="form-control" type="text" name="user_id" />
							<span class="focus-input100"></span>
							</div>
							
							<div class="form-group wrap-input100 validate-input m-b-12" data-validate = "Password is required">
							<span class="btn-show-pass">
								<i class="fa fa-eye"></i>
							</span>
						    <input class="form-control" type="password" name="user_pwd" />
						    <span class="focus-input100"></span>
					        </div>
							<div class="form-group">
								<button class="btn btnRed widthFull">Login</button>
							</div>

						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<footer class="footerSec">
	<div class="wrapper">
	<div class="col-sm-6 float-left mapSec">
		<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.1776418764157!2d88.35440951495954!3d22.572458385182813!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0277ad40000001%3A0xba41a2d55ed8f87e!2sWest%20Bengal%20State%20Multipurpose%20Consumers&#39;%20Co-operative%20Federation%20Ltd.%20(CONFED-W.B.)!5e0!3m2!1sen!2sin!4v1634543122314!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" width="100%" height="150"></iframe>-->
		</div> 
	<div class="col-sm-6 float-left addressSec">
		<h2>Location</h2>
		<p>87, MADHUPANDIT  ROAD, P.O-TALPUKUR,<br>
		24 PARGANAS (NORTH) ,700123</p>
		<ul>
		<li><i class="fa fa-phone" aria-hidden="true"></i> 91 33 2237-7012</li>
		<li><i class="fa fa-fax" aria-hidden="true"></i> +91 33 2237-7013</li>
		<li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:confedwb.org@gmail.com">confedwb.org@gmail.com</a></li>
		</ul>
	</div>
	</div><br clear="all">

</footer>
	<div id="dropDownSelect1"></div>
<!--===============================================================================================-->
	<script src="<?php echo base_url("/assets/login/vendor/jquery/jquery-3.2.1.min.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("/assets/login/vendor/animsition/js/animsition.min.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("/assets/login/vendor/bootstrap/js/popper.js")?>"></script>
	<script src="<?php echo base_url("/assets/login/vendor/bootstrap/js/bootstrap.min.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("/assets/login/vendor/select2/select2.min.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("/assets/login/")?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url("/assets/login/vendor/daterangepicker/daterangepicker.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("/assets/login/vendor/countdowntime/countdowntime.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("/assets/login/js/main.js")?>"></script>
</body>
</html>

