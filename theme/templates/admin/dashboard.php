
<?php
session_start();

if (!isset($_SESSION['user'])) {
	header("location: index.html");
}else{
	$un = $_SESSION['user'];
}

?>


<html lang="en" onload="loadmessage()">

<meta charset="utf-8">
 <title>Events Tabulating System</title>
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
<link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">


<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-multi-select/css/multi-select.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-notific8/jquery.notific8.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-toastr/toastr.min.css"/>

<link href="../../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css">
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css">
<link href="../../assets/global/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css">
<link id="style_color" href="../../assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css">
<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="../img/pic1.png">
<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content page-full-width">
<!-- BEGIN HEADER -->
<div class="page-header -i navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo" style="float: left;">
			<a href="">
			<img src="../img/pic1.png" style="margin-top: 4px; margin-right: 10px;" width="40px" height="40px">
			</a>
			<p style="color: white; float: left; font-family: arial; font-size: 14px; margin-top: 10px;">EVENTS TABULATION</p>
		</div>
		<a href="javascript:;" style="float: right;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<span id="userlabel" class="username username-hide-on-mobile">
					</span>
					<i class="icon-user"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li onclick="$('#edit_profile').modal('show');">
							<a href="#">
							<i class="icon-user"></i> My Profile </a>
						</li>
						<li onclick="$('#change_pass').modal('show');">
							<a href="#">
							<i class="icon-lock"></i> Change Password </a>
						</li>
						<li>
							<a onclick="logout()">
								<i class="icon-key"></i> Log Out 
							</a>
						</li>
					</ul>
				</li>
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content" style="min-height:388px">

			<!-- Profile CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="edit_profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<form method="POST" autocomplete="off">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Edit Profile Information</h4>
						</div>

						<?php
						require 'dbcon.php';

						$query = "select * from users where userid = $un";

						$result = $conn->query($query);
						$row = $result->fetch_assoc();

						//Declaring Variables
						$firstn = $row['userfirstname'];
						$middlen = $row['usermiddlename'];
						$lastn = $row['userlastname'];
						$usern = $row['username'];
						$gen = $row['gender'];	
						$cpas = $row['password'];

						?>

						<div class="modal-body">
							 <div class="form-group">
							 <input type="text" id="fname" class="form-control" name="fname" onkeypress="return onlyAlphabets(event,this);" placeholder="Firstname" value="<?php echo $firstn; ?>"><br>
							 <input type="text" id="mname" class="form-control" name="mname" onkeypress="return onlyAlphabets(event,this);" placeholder="Middlename" value="<?php echo $middlen; ?>"><br>
							 <input type="text" id="lname" class="form-control" name="lname" onkeypress="return onlyAlphabets(event,this);" placeholder="Lastname" value="<?php echo $lastn; ?>"><br>
							 <input type="text" id="usern" class="form-control" name="usern" placeholder="Username" value="<?php echo $usern; ?>"><br>

							 <select class="form-control" name="gender">
							 	<option disabled></option>
							 	<option selected> <?php echo $gen; ?> </option>
							 	<option disabled>Select Gender:</option>
							 	<option>Male</option>
							 	<option>Female</option>
							 </select>
							 </div>
							 <div class="form-group">
							 <h4 class="form-title">Provide your Password</h4>
							 <input type="password" class="form-control" name="cupwd" placeholder="Current Password"><br>
							 <input type="password" class="form-control" name="cpwd" placeholder="Confirm Password"><br>
							 </div>

						</div>
						<div class="modal-footer">
							<button type="submit" name="sub" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					</form>
					<?php

					if (isset($_POST['sub'])) {

						//declaring variables
						$fn = $_POST['fname'];
						$mn = $_POST['mname'];
						$ln = $_POST['lname'];
						$usn = $_POST['usern'];
						$gen = $_POST['gender'];

						//variables in password
						$cupwd = $_POST['cupwd'];
						$cpwd = $_POST['cpwd'];

						$query1 = "update users set userfirstname = '$fn', usermiddlename = '$mn', userlastname = '$ln', username = '$usn' where userid = $un";

						if ($cpas == md5($cupwd)) {
							if ($cupwd == $cpwd) {
								if ($conn->query($query1)) {
									?>
									<script type="text/javascript">
										alert("Successfully Saved!");
									</script>
									<?php
								}else{
									?>
									<script type="text/javascript">
										alert("Error in Saved!");
									</script>
									<?php
								}
							}else{
								?>
									<script type="text/javascript">
										alert("Password does not Match!");
									</script>
									<?php
							}
						}else{
							?>
									<script type="text/javascript">
										alert("Invalid Current Password!");
									</script>
									<?php
						}

					}

					?>
				</div>
			</div>

			<!-- POP PASSWORD MODAL FORM IN DELETING EVENTS-->
			<div class="modal fade" id="poppass1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<form method="POST" autocomplete="off">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Input Your Password</h4>
						</div>

						<div class="modal-body">
							 <div>
							 <input type="password" id="curpw" class="form-control" name="curpwd" placeholder="Current Password"><br>
							 <input type="password" id="conpw" class="form-control" name="renewpwd" placeholder="Confirm Password"><br>
							 </div>
						</div>
						<div class="modal-footer">
							<button type="button" onclick="deleteevent(id)" class="btn blue">Save Changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					</form>
				</div>
			</div>

			<!-- POP PASSWORD MODAL FORM IN DELETING EVENTS-->
			<div class="modal fade" id="change_pass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<form method="POST" autocomplete="off">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Change Your Password</h4>
						</div>

						<div class="modal-body">
							 <div>
							 <input type="password" id="password" class="form-control" name="curpwd" placeholder="Current Password"><br>
							 <input type="password" id="password" class="form-control" name="newpwd" placeholder="New Password"><br>
							 <input type="password" id="password" class="form-control" name="renewpwd" placeholder="Confirm Password"><br>
							 </div>
							 <div>
							 	<input type="button" name="" class="btn btn-primary" id="click" value="Change Security Question and Answer">
							 	<script type="text/javascript">
							 		$("#click").click(function () {
							 			$("#change_quest").toggle();
							 		})
							 	</script>
							 </div>
							  <br>
							  <?php

							  $query2 = "select * from users where userid = $un";
							  $res = $conn->query($query2);
							  $row1 = $res->fetch_assoc();
							  $curpass = $row1['password'];

							  ?>
							 <div id="change_quest" style="display: none;">
							 	<select name="quest" class="form-control">
							 		<option disabled>Used Question:</option>
							 		<option selected><?php echo $row1['userquestion']; ?></option>
							 		<option disabled>Select Security Question:</option>
							 		<option>What is Your Favorite Color?</option>
									<option>What is Your Favorite Fruit?</option>
									<option>Who is Your Favorite Teacher?</option>
									<option>Who is Your Crush?</option>
							 	</select><br>
							 	<input type="text" name="ans" placeholder="Answer" class="form-control" value=""><br>
							 </div>
						</div>
						<div class="modal-footer">
							<button type="submit" name="sub1" class="btn blue">Save Changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					</form>
					<?php

					if (isset($_POST['sub1'])) {

						//Declaring Variables
						$curpwd = $_POST['curpwd'];
						$newpwd = $_POST['newpwd'];
						$renewpwd = $_POST['renewpwd'];
						$quest = $_POST['quest'];
						
						if (empty($_POST['ans'])) {
							$ans = $row1['useranswer'];
						}else{
							$ans = $_POST['ans'];
						}

						$query3 = "update users set password = md5('$newpwd'), userquestion = '$quest', useranswer = '$ans' where userid = $un";

						if ($curpass == md5($curpwd)) {
							if ($newpwd == $renewpwd) {
								if ($conn->query($query3)) {
									?>

									<script type="text/javascript">
										alert("Successfully Changed!");
									</script>

									<?php
								}
							}else{
								?>

									<script type="text/javascript">
										alert("Password does not Match!");
									</script>

									<?php
							}
						}else{
							?>

									<script type="text/javascript">
										alert("Invalid Current Password!");
									</script>

									<?php
								}
						}

					?>
				</div>
			</div>

<?php include('../modals/modalEdit.html'); ?>
<?php include('../modals/modalAdd.html');  ?>

			<div class="row">
				<div class="col-md-3">
					<div class="row">	
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" onclick="window.location = '#content'">
							<div id="dash-1" class="dashboard-stat purple-plum" style="cursor: pointer;">
								<div class="visual">
									<i class="fa fa-home"></i>
								</div>
								<div class="details" style="cursor: pointer;">
									<div class="number">
										 Home
									</div>
									<div class="desc">
										 
									</div>
								</div>
								<!-- <a class="more" href="javascript:;">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a> -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" onclick="window.location = '#content'">
							<div id="dash-2" class="dashboard-stat blue-madison" style="cursor: pointer;">
								<div class="visual">
									<i class="fa fa-user"></i>
								</div>
								<div class="details" style="cursor: pointer;">
									<div class="number">
										 Admin
									</div>
									<div class="desc">
										 Manipulate records
									</div>
								</div>
								<!-- <a class="more" href="javascript:;">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a> -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" onclick="window.location = '#content'">
							<div id="dash-3" class="dashboard-stat green-haze" style="cursor: pointer;">
								<div class="visual">
									<i class="fa fa-bar-chart-o"></i>
								</div>
								<div class="details" style="cursor: pointer;">
									<div class="number">
										 Events
									</div>
									<div class="desc">
										 Result
									</div>
								</div>
								<!-- <a class="more" href="javascript:;">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a> -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" onclick="window.location = '#content'">
							<div id="dash-4" class="dashboard-stat red-intense" style="cursor: pointer;">
								<div class="visual">
									<i class="fa fa-bar-chart-o"></i>
								</div>
								<div class="details" style="cursor: pointer;">
									<div class="number">
										 Criteria
									</div>
									<div class="desc">
										  Result
									</div>
								</div>
								<!-- <a class="more" href="javascript:;">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a> -->
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" onclick="window.location = '#content'">
							<div id="dash-5" class="dashboard-stat yellow-crusta" style="cursor: pointer;">
								<div class="visual">
									<i class="fa fa-bar-chart-o"></i>
								</div>
								<div class="details" style="cursor: pointer;">
									<div class="number">
										  Graphical 
									</div>
									<div class="desc">
										  Reports
									</div>
								</div>
								<!-- <a class="more" href="javascript:;">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a> -->
							</div>
						</div>
					</div>
				</div>
				<div id="content" class="col-md-9">
					<div id="well-1" class="well" style="min-height:86%; display:hidden;background-color: #FFF;">
						<center style="min-height: 97%;">
							<img src="../img/pic1.png" style="margin:auto;width:300px;height:300px;margin-top: 112px;">
						</center>
					</div>
					<div id="well-2" class="well" style="min-height:86%; display:hidden">
						<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								Tabbed content
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title="" title="">
								</a>
								<!-- <a href="#static1" data-toggle="modal" class="config" data-original-title="" title="">
								</a> -->
								<a href="javascript:;" class="reload" data-original-title="" title="">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab_2_1" data-toggle="tab" aria-expanded="false">
									Activities </a>
								</li>
								<li class="">
									<a href="#tab_2_2" data-toggle="tab" aria-expanded="false">
									Event </a>
								</li>
								<li class="">
									<a href="#tab_2_3" data-toggle="tab" aria-expanded="false">
									Contestant </a>
								</li>
								<li class="">
									<a href="#tab_2_4" data-toggle="tab" aria-expanded="false">
									Judges </a>
								</li>
								<li class="">
									<a href="#tab_2_5" data-toggle="tab" aria-expanded="false">
									Criteria </a>
								</li>
								<li class="">
									<a href="#tab_2_7" data-toggle="tab" aria-expanded="false">
									Department </a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade active in" id="tab_2_1">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-6">
												<div class="btn-group">
													<button id="sample_editable_1_new" class="btn green">
													Add New <i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<div class="col-md-6">
												<div class="btn-group pull-right">
													
												</div>
											</div>
										</div>
									</div>
									<table class="table table-hover table-bordered" id="sample_editable_1">
									<thead>
										<tr>
											<th style="display:none">
												 ID
											</th>
											<th>
												Activiy Name
											</th>
											<th>
												 Date Start
											</th>
											<th>
												 Date End
											</th>
											<th>
												 Edit
											</th>
											<!--<th>
												 Delete
											</th>-->
										</tr>
									</thead>
									<tbody>
										
									</tbody>
									</table>
								</div>
								<div class="tab-pane fade" id="tab_2_2">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-6">
												<div class="btn-group">
													<button id="sample_editable_2_new" class="btn green">
													Add New <i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<div class="col-md-6">
												<div class="btn-group pull-right">
													<select id="allact_evnt2" style="background-color: #F4F7F7; min-width:200px" class="form-control select2me pull-right" data-placeholder="Select..." onchange="fetch_all_eventsbyID($(this).val())">
														<option value=""></option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<table class="table table-hover table-bordered" id="sample_editable_2">
									<thead>
										<tr>
											<th style="display:none">
												 ID
											</th>
											<th>
												Event Name
											</th>
											<th>
												 Event Description
											</th>
											<th>
												 Date
											</th>
											<th>
												 Edit
											</th>
											<th>
												 Delete
											</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
									</table>
								</div>
								<div class="tab-pane fade" id="tab_2_3">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-8">
												<div class="btn-group">
													<button id="sample_editable_3_new" class="btn green">
													Add New <i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<div class="col-md-4">
												<select id="contestantdep2" style="background-color: #F4F7F7;" class="form-control select2me" data-placeholder="Select..." onchange="loadcontbyevntfiltered($(this).val())">
														<option value=""></option>
												</select>
											</div>
										</div>
									</div>
									<table class="table table-hover table-bordered" id="sample_editable_3">
									<thead>
										<tr>
											<th style="display:none">
												 ID
											</th>
											<th>
												 Full Name
											</th>
											<th>
												 Gender
											</th>
											<th>
												 Department
											</th>
											<th>
												 Event
											</th>
											<th>
												 Status
											</th>
											<th>
												 Edit
											</th>
											<th>
												 Delete
											</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
									</table>
								</div>
								<div class="tab-pane fade" id="tab_2_4">
									<div class="table-toolbar">
										<div class="row">
											 <div class="col-md-6">
												<div class="btn-group">
													<button id="sample_editable_4_new" class="btn green">
													Add New <i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<div class="col-md-6">
												<div class="btn-group pull-right">
													<select id="" style="background-color: #F4F7F7;min-width:200px" class="form-control select2me pull-right" data-placeholder="Select..." onchange="($(this).val()!=''?getjudgesbygender($(this).val()) : getjudges())">
														<option value="">all</option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<table class="table table-hover table-bordered" id="sample_editable_4">
									<thead>
										<tr>
											<th style="display:none">
												 ID
											</th>
											<th>
												 Judge Name
											</th>
											<th>
												 Username
											</th>
											<th style="display:none">
												 Password
											</th>
											<th>
												 Gender
											</th>
											<th>
												 Judging Event
											</th>
											<th>
												 Edit
											</th>
											<th>
												 Delete
											</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
									</table>
								</div>
								<div class="tab-pane fade" id="tab_2_5">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-6">
												<div class="btn-group">
													<button id="sample_editable_5_new" class="btn green">
													Add New <i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<div class="col-md-6">
												<div class="btn-group pull-right">
													<select id="eventname3" style="background-color: #F4F7F7; min-width:200px" class="form-control select2me pull-right" data-placeholder="Select..." onchange="getCriteriabyeventname($(this).val())">
														<option value=""></option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<table class="table table-hover table-bordered" id="sample_editable_5">
									<thead>
										<tr>
											<th style="display:none">
												 ID
											</th>
											<th>
												 Criteria Name
											</th>
											<th>
												 Percentage
											</th>

											<th>
												 Events
											</th>
											<th>
												 Edit
											</th>
											<th>
												 Delete
											</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
									</table>
								</div>
								<div class="tab-pane fade" id="tab_2_7">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-6">
												<div class="btn-group">
													<button id="sample_editable_7_new" class="btn green">
													Add New <i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
										</div>
									</div>
									<table id="sample_editable_7" class="table table-hover table-bordered" id="sample_editable_7">
									<thead>
										<tr>
											<th style="display:none">
												 ID
											</th>
											<th>
												 Department Name
											</th>
											<th>
												 Description
											</th>

											<th>
												 Edit
											</th>
											<!--<th>
												 Delete
											</th>-->
										</tr>
									</thead>
									<tbody>
									</tbody>
									</table>
								</div>
							</div>
						</div>
						</div>
					</div>
					<div id="well-3" class="well" style="min-height:86%; display:hidden">
						
							<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label></label>
											<select id="actcombo4score" style="background-color: #F4F7F7;" class="form-control eventcombo4score" data-placeholder="Select..." onchange="loadEventReportsByEventId($(this).val())">
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label></label>
											<select id="evtcombo4score2" style="background-color: #F4F7F7;" class="form-control eventcombo4score2" data-placeholder="Select..." onchange="getevtreport2($(this).val())">
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<a class="btn btn-md blue hidden-print margin-bottom-5" onclick="PrintElem('#WinnerByEvents','Winner by Events')" style="float:right">
											Print <i class="fa fa-print"></i>
										</a>
									</div>
							</div>
							<div class="portlet box blue">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-coffee"></i>Results by Events
									</div>
									<div class="tools">
										<a href="javascript:;" class="collapse" data-original-title="" title="">
										</a>
										<a href="javascript:;" class="reload" data-original-title="" title="">
										</a>
										<a href="javascript:;" class="fullscreen">
										</a>
									</div>
								</div>
								<div class="portlet-body" id="WinnerByEvents">
									
									<div class="table-scrollable">
										<table id="reports2" class="table table-bordered">
										<thead>
										<tr>
											<th>
												 Events
											</th>
											<th>
												 Contestant
											</th>
											<th>
												 Department
											</th>
											<th>
												 Score
											</th>
											<th>
												 Status
											</th>
										</tr>
										</thead>
										<tbody>
										
										

										</tbody>
										</table>
									</div>
								</div>
							</div>
					</div>
					<div id="well-4" class="well" style="min-height:86%; display:hidden">
							<div class="row">
								<div class="col-md-6">
										<div class="form-group">
											<label></label>
											<select id="eventcombo4score" style="background-color: #F4F7F7;" class="form-control select2me eventcombo4score" data-placeholder="Select..." onchange="loadReportsByEventId($(this).val())">
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<a class="btn btn-md blue hidden-print margin-bottom-5" onclick="PrintElem('#WinnerByCriteria','Winner by Criteria')" style="float:right">
											Print <i class="fa fa-print"></i>
										</a>
									</div>
							</div>
							<div class="portlet box blue" id="WinnerByCriteria">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-coffee"></i>Results by Criteria
									</div>
									<div class="tools">
										<a href="javascript:;" class="collapse" data-original-title="" title="">
										</a>
										<a href="javascript:;" class="reload" data-original-title="" title="">
										</a>
										<a href="javascript:;" class="fullscreen">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									
									<div class="table-scrollable">
										<table id="reports1" class="table table-bordered">
										<thead>
										<tr>
											<th>
												 Criteria
											</th>
											<th>
												 Contestant
											</th>
											<th>
												 Department
											</th>
											<th>
												 Score
											</th>
											<th>
												 Status
											</th>
										</tr>
										</thead>
										<tbody>
										
										

										</tbody>
										</table>
									</div>
								</div>
							</div>
					</div>
					<div id="well-5" class="well" style="min-height:100%;">
						<div class="col-lg-12">
							<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<!--<label>Select Activity</label>-->
												<select id="actcombo4score9" style="background-color: #F4F7F7;" class="form-control" data-placeholder="Select..." onchange="getData2($(this).val())">
												</select>
											</div>
										</div>
							</div>
							<div class="portlet light bordered">
									<div class="portlet-title">
										<div class="caption">
											<i class="icon-bar-chart font-green-haze"></i>
											<span class="caption-subject bold uppercase font-green-haze">Overall Winner by Department</span>
										</div>
										<div class="tools">
											<a href="javascript:;" class="collapse">
											</a>
											<!-- <a href="#portlet-config" data-toggle="modal" class="config">
											</a> -->
											<!-- <a href="javascript:;" class="reload">
											</a> -->
											<a href="javascript:;" class="fullscreen">
											</a>
											<a class="hidden-print margin-bottom-5" onclick="PrintElem('#chart_5','Winner by Department')">
												Print <i class="fa fa-print"></i>
											</a>
										</div>
									</div>
									<div class="portlet-body" id="WinnerByDepartment">
										<div id="chart_5" class="chart" style="height: 350px;">
										</div>
										<div class="well margin-top-20">
											<div class="row">
												<div class="col-sm-3">
													<label class="text-left">Top Radius:</label>
													<input class="chart_5_chart_input" data-property="topRadius" type="range" min="0" max="1.5" value="1" step="0.01"/>
												</div>
												<div class="col-sm-3">
													<label class="text-left">Angle:</label>
													<input class="chart_5_chart_input" data-property="angle" type="range" min="0" max="89" value="30" step="1"/>
												</div>
												<div class="col-sm-3">
													<label class="text-left">Depth:</label>
													<input class="chart_5_chart_input" data-property="depth3D" type="range" min="1" max="120" value="40" step="1"/>
												</div>
											</div>
										</div>
									</div>
							</div>
						</div>					
					</div>

				</div>
			</div>
			<!-- END PAGE CONTENT--> 
		</div>
	</div>
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2018 © Event Tabulating System
	</div>
	<div class="scroll-to-top" style="display: block;">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script src="../../assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!--this is for datepickers and time pickers  --> 
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- this is for am-charts -->
<script src="../../assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/charts-amcharts.js"></script>

<!--this is for select options  --> 
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>

<!--this is for datatables --> 
<script type="text/javascript" src="../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<!--this is for toastr and notifications  --> 
<script src="../../assets/global/plugins/jquery-notific8/jquery.notific8.min.js"></script>
<script src="../../assets/admin/pages/scripts/ui-notific8.js"></script>
<script src="../../assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="../../assets/admin/pages/scripts/ui-toastr.js"></script>
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/index.js" type="text/javascript"></script>

<!-- this is for pulsate -->
<script src="../../assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/components-pickers.js"></script>
<script src="../../assets/admin/pages/scripts/components-dropdowns.js"></script>

<!--this is our code  --> 
<script src="../../assets/admin/pages/scripts/table-editable.js"></script>
<script src="../../assets/admin/pages/scripts/table-editable2.js"></script>
<script src="../../assets/admin/pages/scripts/table-editable3.js"></script>
<script src="../../assets/admin/pages/scripts/table-editable4.js"></script>
<script src="../../assets/admin/pages/scripts/table-editable5.js"></script>
<script src="../../assets/admin/pages/scripts/table-editable7.js"></script>
<script src="../../assets/global/scripts/dashboard.js"></script> 
<script src="../../assets/global/scripts/reports.js"></script> <!-- the code for the reports.. -->
<script src="../../assets/global/scripts/aes.js"></script> 
<script type="text/javascript" src="function.js"></script>

<!-- initiallization -->
<script>
    jQuery(document).ready(function() {    
        Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		QuickSidebar.init(); // init quick sidebar
		Demo.init(); // init demo features

		ChartsAmcharts.init(); // init demo charts
		ChartsAmcharts2.init(); // init demo charts

		Index.init();   
		ComponentsPickers.init();
		ComponentsDropdowns.init();

		TableEditable.init();
		TableEditable2.init();
		TableEditable3.init();
		TableEditable4.init();
		TableEditable5.init();
		TableEditable7.init();
		UINotific8.init();
		UIToastr.init();

		if(sessionStorage['islogin'] = false){
			window.location = 'index.html';
		}
	});
  </script>

  <!-- customized your toastr options -->
  <script type="text/javascript">
  		 toastr.options = {
			  "closeButton": true,
			  "debug": false,
			  "positionClass": "toast-bottom-right",
			  "onclick": null,
			  "showDuration": "5000",
			  "hideDuration": "5000",
			  "timeOut": "1500",
			  "extendedTimeOut": "5000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut" 	
			}
  		function loadmessage(){
  			toastr.success('Success!', 'Welcome Admin !');
  		}
		
  </script>

  <script type="text/javascript">

    function PrintElem(elem,text)
    {
        Popup1($(elem).html(),text);
    }
   

    function Popup1(data,text) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=900');
        mywindow.document.write('<html><head><title>'+text+'</title>');
        mywindow.document.write('<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<center><div>');
        mywindow.document.write('<div style="float:left">');
        mywindow.document.write('<img src="../img/pic1.png" style="height:100px; margin-right:10px"></img>');
        mywindow.document.write('</div>');
        mywindow.document.write('<div style="float:right;">');
        mywindow.document.write('<img src="../img/pic2.png" style="height:100px; margin-left:10px" ></img>');
        mywindow.document.write('</div>');
        mywindow.document.write('<small>Republic of the Philippines</small><br>'+
								'<small>NUEVA ECIJA UNIVERSITY OF SCIENCE AND TECHNOLOGY</small><br>'+
								'<small>Bayanihan, Gapan City, Nueva Ecija</small><br>'+
								'<small>☎ (044) 486-0806  neust.edu.ph</small>');
        mywindow.document.write('</div><br><br>');
        mywindow.document.write('</center>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

   
</script>
  		
  </body>
  </html>