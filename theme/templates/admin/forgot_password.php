<html lang="en">
<meta charset="utf-8">
<title>Events Tabulating System | Forgot Password Form</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description">
<meta content="" name="author">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="../../assets/admin/pages/css/opensans.css" rel="stylesheet" type="text/css">
<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="../../assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css">
<link href="../../assets/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css">
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-toastr/toastr.min.css"/>
<link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css">
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css">
<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css">
<link id="style_color" href="../../assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css">
<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="../img/pic1.png">
<script type="text/javascript" src="forgotshow.js"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<br><br><br>
<body class="login">
<!-- BEGIN LOGO
<div class="logo">
	<a href="">
	<img src="../img/pic1.png" alt="NEUST LOGO">
	</a>
</div>
END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" method="POST" style="padding-bottom: 30PX;">
		<h3 class="form-title">Forgot Password</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span></span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<div class="input-icon">
				<i class="icon-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" value="<?php if(isset($_POST['sub'])){ echo $_POST['username']; }else{echo '';} ?>" name="username" id="username" autofocus>
			</div>
		</div>
		<div class="form-group">
			<div class="input-icon">
				<i class="icon-question"></i>
				<select class="form-control" autocomplete="off" name="quest" id="quest">
					<option disabled>Select Security Question</option>
					<option>What is Your Favorite Color?</option>
					<option>What is Your Favorite Fruit?</option>
					<option>Who is Your Favorite Teacher?</option>
					<option>Who is Your Crush?</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="input-icon">
				<i class="icon-lock"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Answer" value="<?php if(isset($_POST['sub'])){ echo $_POST['ans']; }else{echo '';} ?>" name="ans" id="ans">
			</div>
		</div>
		<div class="form-group">
			<div class="input-icon">
				<i class="icon-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="New Password" name="pass" id="pwd1">
			</div>
		</div>
		<div class="form-group">
			<div class="input-icon">
				<i class="icon-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Confirm Password" name="repass" id="pwd2">
			</div>
		</div>

		<div class="form-group">
			<div class="input-icon">
				<label><input class="form-control" type="checkbox" id="eye"> Show password</label>
				<!--<i>show password</i>-->
				<script type="text/javascript" src="forgotshow.js"></script>
			</div>
		</div>
		<div class="form-actions">
			
			<div class="pull-left">
				<button type="button" class="btn blue" onclick=" window.location = 'index.html';">
				<i class="m-icon-swapleft m-icon-white"></i> Back To Login</button>
			</div>

			<div class="pull-right">
				<button type="submit" name="sub" class="btn blue" onclick="//forgotpass()">
				Submit <i class="m-icon-swapright m-icon-white"></i>
				</button>
			</div>
		</div>
		</form>
<!-- PHP Script -->
<?php
if (isset($_POST['sub'])) {

	//link of database connection
	require 'dbcon.php';

	//declaration of variables
	$un = $_POST['username'];
	$quest = $_POST['quest'];
	$ans = $_POST['ans'];
	$pw = $_POST['pass'];
	$repw = $_POST['repass'];

	//SQL Commands
	$sql = "select * from users where username = '$un'";
	$sql1 = "UPDATE users set password = md5('$pw') where username = '$un'";

	//Querying Data
	$user_scanning = $conn->query($sql);

	//fetching data
	$fetch = $user_scanning->fetch_assoc();

	//checking if the user is registered to database
	if ($fetch['username'] == $un) {

		//checking if the password is match
		if ($pw == $repw) {

			//checking if the question or answer is match
			if ($fetch['userquestion'] == $quest and $fetch['useranswer'] == $ans) {
				if ($conn->query($sql1)) {

					?>
					<script type="text/javascript">
						alert("Change Successfully!");
						window.location = "index.html";
					</script>
					<?php
				}else{

				?>

				<script type="text/javascript">
					window.alert("Error in Connecting Database!");
				</script>

				<?php
	
				}
			}else{

			?>

			<script type="text/javascript">
				window.alert("Question or Answer is Invalid!");
			</script>

			<?php
	
			}
		}else{

			?>

			<script type="text/javascript">
				window.alert("Password does not Match!");
			</script>

			<?php

		}
	}else{

			?>

			<script type="text/javascript">
				window.alert("Invalid Username!");
			</script>

			<?php

	}
}
?>
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 2018 © Events Tabulating System.
</div>

<!--<script src="../js/pages/login.js"></script>-->

<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script src="../../assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="../../assets/admin/pages/scripts/ui-toastr.js"></script>
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  Metronic.init(); // init metronic core components
  Layout.init(); // init current layout
  Login.init();
  Demo.init();
  UIToastr.init();
       // init background slide images
       $.backstretch([
        "../../assets/admin/pages/media/bg/1.jpg",
        "../../assets/admin/pages/media/bg/2.jpg",
        "../../assets/admin/pages/media/bg/3.jpg",
        "../../assets/admin/pages/media/bg/4.jpg"
        ], {
          fade: 1000,
          duration: 8000
    }
    );
});
</script>

</body>
</html>