<?php
	include('../../server/cors.php');
	include('../../server/finduser/controller.php');

	$method = $_SERVER['REQUEST_METHOD'];
	$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

	switch ($method) {
	  case 'PUT':
	    break;
	  case 'POST':
			$data["username"] = $_POST['username'];
			$data["quest"] = $_POST['quest'];
			$data["ans"] = $_POST['ans'];
			$data["pass"] = $_POST['pass'];
			$data["repass"] = $_POST['repass'];
	 	 LoginCtrl::login($data);
	    break;
	  case 'GET':
	  	break;
	  case 'DELETE':
	    break;
	}
	exit();

?>
