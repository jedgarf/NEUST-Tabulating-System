<!--<html lang="en" onload="loadmessage()">-->

<meta charset="utf-8">
 <title>Events Tabulating System</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description">
<meta content="" name="author">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="assets/admin/pages/css/opensans.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">


<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/jquery-multi-select/css/multi-select.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/jquery-notific8/jquery.notific8.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-toastr/toastr.min.css"/>

<link href="assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css">
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css">
<link href="assets/global/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css">
<link id="style_color" href="assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css">
<link href="assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="img/pic1.png">

</head>
<body class="page-header-fixed page-quick-sidebar-over-content page-full-width">
<!-- BEGIN HEADER -->
<div class="page-header -i navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo" style="float: left;">
			<a href="">
			<img src="img/pic1.png" style="margin-top: 4px; margin-right: 10px;" width="40px" height="40px">
			</a>
			<p style="color: white; float: left; font-family: arial; font-size: 14px; margin-top: 10px;">EVENTS TABULATION</p>
		</div>
		<a href="javascript:;" style="float: right;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right" style="margin-top: 10px;">
				<!--<li class="dropdown dropdown-user">-->
					<a href="redirect.php" style="color: white;text-decoration-line: none;">
					<!-- class="icon-user"-->
					<p style="font-size: 20px; font-weight: bold;" class="icon-user" title="Login to admin or judge"> &nbsp;LOG-IN</p>
					</a>
					<!-- <ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="#">
							<i class="icon-user"></i> My Profile </a>
						</li>
						<li>
							<a onclick="logout()">
								<i class="icon-key"></i> Log Out 
							</a>
						</li>
					</ul>
				</li>
				END QUICK SIDEBAR TOGGLER
			</ul> -->
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
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

<div class="row">
<div class="col-md-3">

<?php

require 'dbcon.php';

$sql = "select eventid, eventname from events";
$res = $conn->query($sql);
$x = 1;
if ($res->num_rows > 0) {
	while($row = $res->fetch_assoc()){

?>
					<div class="row">	
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div id="dash-1" class="dashboard-stat green-haze" style="cursor: pointer;">
								<div class="visual">
									<i class="fa fa-bar-chart-o"></i>
								</div>
								<div class="details" style="cursor: pointer;" onclick="window.location = '#link<?php echo $x; ?>'">
									<div class="number">
										 <?php echo $row['eventname']; ?>
									</div>
									<div class="desc">
										 
									</div>
								</div>
							</div>
						</div>
					</div>
<?php $x = $x+1; } }else{
	echo "<h1 style = 'font-weight: bolder; text-align: center;'>0 Events</h1>";
} ?>

			</div>

				<div class="col-md-9">
					<div id="well-1" class="well" style="min-height:86%; display:hidden;background-color: #FFF;">
						<?php
						$sql1 = "select * from events";
						$res1 = $conn->query($sql1);
						$y = 1;
						while ($row1 = $res1->fetch_assoc()) {
							echo "<h1 id='link".$y."' style='font-family: arial; font-weight: bolder;'>".$row1['eventname']."</h1><h4 style='font-weight: bolder;'>Description</h4><div style='float: left;'>".$row1['eventdescription']."</div><div style='float: right;'>".date("F-d-Y", strtotime($row1['eventdate']))."</div><br>";
							echo "<h4 style='font-weight: bolder;'>List of Contestant/Player:</h4>";
							echo "<div style='float: left;'>";
							echo "<h5 style = 'font-weight: bolder;'>Full Name</h5>";
							$sql2 = "select name from contestants where eventid = '".$row1['eventid']."'";
							$res2 = $conn->query($sql2);
							$yy = 1;
							while ($row2 = $res2->fetch_assoc()) {
								echo "<h5><span>".$yy.". </span>".$row2['name']."</h5>";
								$yy = $yy + 1;
							}
							echo "</div>";
							echo "<div style='float: left;'>";

							echo "</div>";
							echo "<br><br><br><br>";
						$y = $y + 1;
						}

						?>
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
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!--this is for datepickers and time pickers  --> 
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>


<!-- this is for am-charts
<script src="assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/charts-amcharts.js"></script>
-->
<!--this is for select options  --> 
<script type="text/javascript" src="assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>

<!--this is for datatables --> 
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<!--this is for toastr and notifications  --> 
<script src="assets/global/plugins/jquery-notific8/jquery.notific8.min.js"></script>
<script src="assets/admin/pages/scripts/ui-notific8.js"></script>
<script src="assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="assets/admin/pages/scripts/ui-toastr.js"></script>
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/index.js" type="text/javascript"></script>

<!-- this is for pulsate -->
<script src="assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/components-pickers.js"></script>
<script src="assets/admin/pages/scripts/components-dropdowns.js"></script>

<!--this is our code  --> 
<!--<script src="assets/admin/pages/scripts/table-editable.js"></script>
<script src="assets/admin/pages/scripts/table-editable2.js"></script>
<script src="assets/admin/pages/scripts/table-editable3.js"></script>
<script src="assets/admin/pages/scripts/table-editable4.js"></script>
<script src="assets/admin/pages/scripts/table-editable5.js"></script>
<script src="assets/admin/pages/scripts/table-editable7.js"></script>
<script src="assets/global/scripts/dashboard.js"></script> 
<script src="assets/global/scripts/reports.js"></script>--> <!-- the code for the reports.. -->
<!--<script src="assets/global/scripts/aes.js"></script> -->

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
  		/*toastr.options = {
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
  			toastr.success('Success', 'Welcome Admin !');
  		}
		
  </script>

  <script type="text/javascript">

  /*  function PrintElem(elem,text)
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
								'<small>☎ 034.435.7359  neust.edu.ph</small>');
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