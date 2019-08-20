<?php

session_start();

					#require 'dbcon.php';


					#$usid = $_SESSION['user'];

					if (isset($_SESSION['user'])) {
						$usid = $_SESSION['user'];
					}elseif (!isset($_SESSION['user'])) {
						header("location: ../../../redirect.php");
					}else{
						echo "Error in session!";
					}

?>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8">

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

<link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css">
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css">
<link href="../../assets/global/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css">
<link id="style_color" href="../../assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css">
<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="../img/pic1.png">
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
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<!--<img alt="" class="img-circle" src="../../assets/admin/layout/img/avatar3_small.jpg">-->
					<span id="userlabel" class="username username-hide-on-mobile">
					</span>
					<i class="icon-user"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li onclick="$('#edit_profile').modal('show');">
							<a href="#">
							<i class="icon-user"></i> My Profile </a>
						</li>
						<li>
							<a href="../../../logout.php">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="javascript:;" class="dropdown-toggle">
					<i class="icon-logout"></i>
					</a>
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
			<!-- EDIT PROFILE CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="edit_profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<form method="POST" autocomplete="off">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Change Security Question and Answer</h4>
						</div>
						<?php
						require 'dbcon.php';
						$sql2 = "select * from users where userid = '$usid'";
						$res1 = $conn->query($sql2);
						$value = $res1->fetch_assoc();
						?>

						<div class="modal-body">
							<div class="form-group">
								<div class="input-icon">
							 <select class="form-control" id="quest" name="quest">
							 	<option disabled>Select Security Question:</option>
							 	<option>What is Your Favorite Color?</option>
							 	<option>What is Your Favorite Fruit?</option>
							 	<option>Who is Your Favorite Teacher?</option>
							 	<option>Who is Your Crush?</option>
							 </select>
							</div>
							</div>
							<div class="form-group">
								<div class="input-icon">
							 <input type="text" class="form-control" name="ans" value="" placeholder="Security Answer">
							</div>
							</div>
							<div class="form-group">
								<div class="input-icon">
							 <input type="password" class="form-control" name="curpass" placeholder="Current Password">
							</div>
							</div>
							<div class="form-group">
								<div class="input-icon">
							 <input type="password" class="form-control" name="repass" placeholder="Confirm Password">
							</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" name="sub1" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</form>
				<?php

				if (isset($_POST['sub1'])) {
					$quest = $_POST['quest'];
					$ans = $_POST['ans'];
					$curpass = $_POST['curpass'];
					$repass = $_POST['repass'];

					$sql1 = "update users set userquestion = '$quest', useranswer = '$ans' where userid = '$usid'";
					if ($value['password'] == md5($curpass)) {
					if ($curpass == $repass){
					if ($conn->query($sql1)) {
						?>

						<script type="text/javascript">
							window.alert("Successfully Saved!");
						</script>

						<?php
					}else{
						?>

						<script type="text/javascript">
							window.alert("Error in Saving!");
						</script>

						<?php
					}
				}else{
					?>

					<script type="text/javascript">
						window.alert("Password Does Not Match!");
					</script>

					<?php
				}
			}else{
				?>

					<script type="text/javascript">
						window.alert("Invalid Current Password!");
					</script>

					<?php
			}

				}
				?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->

					<?php

					$sql = "select act.actname, ev.eventname, ev.eventid from users us left join events ev on us.eventid = ev.eventid left join activities act on act.actid = ev.actid where us.userid = '$usid'";


					$result = $conn->query($sql);
					$row = $result->fetch_assoc();
					$actname = $row['actname'];
					$evname = $row['eventname'];
					$evid = $row['eventid'];

					?>

					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption" style="text-transform: uppercase; font-weight: bolder;">
								<?php echo $actname; ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title="" title="">
								</a>
								</a>
								<a href="javascript:;" class="reload" data-original-title="" title="">
								</a>
								<a href="javascript:;" class="fullscreen">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Event Name</label>
										<!--<select id="event4judge" style="background-color: #F4F7F7;" class="form-control select2me eventcombo4judge" data-placeholder="Select..." onchange="loadContestantWhenEventComboChange($(this).val())">
											
										</select>-->
										<label class="form-control" style="text-transform: uppercase; border: none; font-weight: bolder; font-size: 20px;"><?php echo $evname; ?></label>

										<input type="text" name="" id="event4judge" class="form-control" value="<?php echo $evid; ?>" style = "display: none;">
									</div>
								</div>
								<div class="col-md-6">

									<div class="form-group">
										<label>Select Candidate</label>
										<select id="candidate4judge" style="background-color: #F4F7F7;" class="form-control select2me " data-placeholder="Select..." onchange="loadCriteriaByEventId($('#event4judge').val())">
											<?php
											$sql3 = "select contestantid, name from contestants where eventid= '$evid' and contestanttype = 'qualified'";
											$result1 = $conn->query($sql3);
											if ($result1->num_rows >= 1) {
												while ($combo2 = $result1->fetch_assoc()) {
												echo "<option value=" .$combo2['contestantid']. ">" .$combo2['name']. "</option>";
												}
											}else{
												echo "<option disabled>No Candidate in This Event..</option>";
											}
											 ?>
										</select>
									</div>

								</div>
							</div>
							<div class="table-toolbar">
										<div class="row">
											<!-- <div class="col-md-6">
												<div class="btn-group">
													<button id="sample_editable_1_new" class="btn green">
													Add New <i class="fa fa-plus"></i>
													</button>
												</div>
											</div> -->
											<div class="col-md-6">
												<div class="btn-group pull-right">
													
												</div>
											</div>
										</div>
							</div>
							<table class="table table-hover table-bordered" id="sample_editable_6">
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
												 Score
											</th>
											<th style="text-align:center;">
												 Action
											</th>
										</tr>
							</thead>
							<tbody>
										
									</tbody>
							</table>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
				<!--<div class="col-md-4">
					<div class="col-md-12" style="border: 1px solid #26A69A;color: #26A69A;text-align: center;background: #F4F7F7;">
						<h2>Ms. Jocelyn Dumapias</h2>
					</div>
					<img src="../img/2.jpg" width="100%" height="422px" style="border: 1px #26A69A solid;">
				</div>	-->

			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
</div>

<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2018 © Events Tabulating System
	</div>
	<div class="scroll-to-top" style="display: block;">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
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

<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript" src="../../assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>

<script type="text/javascript" src="../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script src="../../assets/global/plugins/jquery-notific8/jquery.notific8.min.js"></script>
<script src="../../assets/admin/pages/scripts/ui-notific8.js"></script>

<script src="../../assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="../../assets/admin/pages/scripts/ui-toastr.js"></script>
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/components-pickers.js"></script>
<script src="../../assets/admin/pages/scripts/components-dropdowns.js"></script>

<script src="../../assets/admin/pages/scripts/table-editable6.js"></script>


<script>
    jQuery(document).ready(function() {    
        Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		QuickSidebar.init(); // init quick sidebar
		Demo.init(); // init demo features
		ComponentsPickers.init();
		ComponentsDropdowns.init();

		//TableEditable6.init();
		UINotific8.init();
		UIToastr.init();

	});
  </script>
								
  </body></html>