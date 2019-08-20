<?php
include('../../server/connection.php');

class LoginModel {

	function __construct(){
    }

	public static function login($data){
		$config= new Config();

		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{

			$username = $mysqli->real_escape_string($data['username']);
			$quest = $mysqli->real_escape_string($data['quest']);
			$ans = $mysqli->real_escape_string($data['ans']);
			$pass = $mysqli->real_escape_string($data['pass']);
			$repass = $mysqli->real_escape_string($data['repass']);

			?>
			<script type="text/javascript">
				console.log("<?php echo $username; ?>");
			</script>
			<?php
			
			$query1 ="SELECT u.userid as user, u.userfirstname, u.usermiddlename, u.userlastname, u.username, u.userquestion, u.useranswer, ua.acctype FROM users u join useraccounts ua on u.userid = ua.userid where u.username = '$username'";
			
			$result = $mysqli->query($query1);

			if ($result) {
	            $row = $result->fetch_assoc();
	            	if($result->num_rows > 0){
	                	if($row['userquestion'] == $quest and $row['useranswer'] == $ans){
	                		$un = $row['username'];
	                		$query2 ="UPDATE users set password = md5('$pass') where username = '$un'";
			
							$mysqli->query($query2);

	                		/*** set the session userid variable ***/
		                	session_start();
		                	$_SESSION['user'] = $row['user'];
	    	            	/*** set a form token ***/
	        	        	$form_token = md5( uniqid('auth', true) );

		        	        /*** set the session form token ***/
		            	    $_SESSION['auth_token'] = $form_token;
	    	            	/*** tell the user we are logged in ***/
	        	       		print json_encode(array('success' =>true,'status'=>200,'form_token' =>$form_token,'childs'=>$row));
	            	    }else{
	                		$message = 'Invalid Security Question or Answer!';
	                		print json_encode(array('success' =>true,'status'=>200,'msg' =>$message));
	                	}
	                }else{
	                	$message = 'Invalid Username!';
	              		print json_encode(array('success' =>true,'status'=>200,'msg' =>$message));
	                }
	        }else{
	            $message = 'Error in Database!';
	            print json_encode(array('success' =>true,'status'=>400,'msg' =>$message));
	        }
			
		}
	}
}
?>
