<?php
require_once '../../server/connection.php';

class JudgesModel {

	function __construct(){
    }

	public static function create($data){
		$config= new Config();

		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$judgefname = $mysqli->real_escape_string($data['judgefname']);
			$judgemname = $mysqli->real_escape_string($data['judgemname']);
			$judgelname = $mysqli->real_escape_string($data['judgelname']);
			$judgeuname = $mysqli->real_escape_string($data['judgeuname']);
			$judgepword = $mysqli->real_escape_string($data['judgepword']);
			$eventid = $mysqli->real_escape_string($data['eventid']);
			$gender = $mysqli->real_escape_string($data['gender']);

			$judgefullname = $judgefname." ".$judgemname." ".$judgelname;
			$pw = md5($judgepword);

			$checkQuery ="SELECT * FROM users where userid <> 1 and (userlastname = '$judgelname' and eventid = $eventid)";
			$ress = $mysqli->query($checkQuery);
			$querydata = array();
			while($row = $ress->fetch_array(MYSQLI_ASSOC)){
				array_push($querydata,$row);
			}
			if(count($querydata) > 0){
				return print json_encode(array('success' =>false,'status'=>500,'msg' =>'judge name already exist', 'data'=>$judgefullname));
			} else {
				if ($stmt = $mysqli->prepare('INSERT INTO users (userfirstname, usermiddlename, userlastname, username, password, gender, eventid) VALUES (?,?,?,?,?,?,?)')){

				$stmt->bind_param('sssssss', $judgefname,$judgemname,$judgelname,$judgeuname,$pw,$gender,$eventid);
				$stmt->execute();
				return print json_encode(array('success' =>true,'status'=>200,'msg' =>'Record successfully saved', 'data'=>$data));
				}else{
					return print json_encode(array('success' =>false,'status'=>500,'msg' =>'Error message: %s\n', $mysqli->error));
				}
			}
			
		}
	}

	public static function read(){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$query1 ="SELECT us.userid, us.userfirstname, us.usermiddlename, us.userlastname, us.username, us.gender, us.password, ev.eventname as evtn FROM users us left join events ev on us.eventid = ev.eventid where userid <> 1";
			$result1 = $mysqli->query($query1);
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			print json_encode(array('success' =>true,'status'=>200,'childs' =>$data));
		}
	}

	public static function detail($id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    return print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		}else{
			$query1 ="SELECT us.userid, us.userfirstname, us.usermiddlename, us.userlastname, us.username, us.password, ev.eventname as evtn FROM users us left join events ev on us.eventid = ev.eventid where us.userid = $id";
			$result1 = $mysqli->query($query1);
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			print json_encode(array('success' =>true,'status'=>200,'childs' =>$data));
		}
	}

	public static function update($id,$data){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$judgecombo = $mysqli->real_escape_string($data['judgecombo']);
			$judgefname = $mysqli->real_escape_string($data['judgefname']);
			$judgemname = $mysqli->real_escape_string($data['judgemname']);
			$judgelname = $mysqli->real_escape_string($data['judgelname']);
			$judgeuname = $mysqli->real_escape_string($data['judgeuname']);
			$judgepword = $mysqli->real_escape_string($data['judgepword']);
			$judgeid = $mysqli->real_escape_string($data['judgeid']);
			$gender = $mysqli->real_escape_string($data['judgegender']);
			$pw = md5($judgepword);

			if ($stmt = $mysqli->prepare('UPDATE users SET userfirstname=?,usermiddlename=?,userlastname=?,username=?,password=?,gender=?,eventid=? WHERE userid=?')){
				$stmt->bind_param('ssssssss', $judgefname,$judgemname,$judgelname,$judgeuname,$pw,$gender,$judgecombo,$judgeid);
				$stmt->execute();
				return print json_encode(array('success' =>true,'status'=>200,'msg' =>'Record successfully saved', 'data'=>$data));
			}else{
				return print json_encode(array('success' =>false,'status'=>500,'msg' =>'Error message: %s\n', $mysqli->error));
			} 
		}
	}

	public static function delete($id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if($stmt = $mysqli->prepare('DELETE FROM users WHERE userid =?')){
			$stmt->bind_param('s', $id);
			$stmt->execute();
			$stmt->close();
			print json_encode(array('success' =>true,'status'=>200,'msg' =>'Record successfully deleted'));
		}else{
			print json_encode(array('success' =>false,'status'=>200,'msg' =>'Error message: %s\n', $mysqli->error));
		}
	}
}
?>
