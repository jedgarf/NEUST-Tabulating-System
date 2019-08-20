<?php
require_once '../../server/connection.php';

class ContestantExt1Model {

	function __construct(){
    }

	public static function create($data){
		/*$config= new Config();

		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$contestantname = $mysqli->real_escape_string($data['contestantname']);
			$departmentid = $mysqli->real_escape_string($data['departmentid']);
			$eventid = $mysqli->real_escape_string($data['eventid']);

			if ($stmt = $mysqli->prepare('INSERT INTO contestants (name,eventid,departmentid) VALUES(?,?,?)')){
				$stmt->bind_param('sss', $contestantname,$eventid,$departmentid);
				$stmt->execute();
				return print json_encode(array('success' =>true,'status'=>200,'msg' =>'Record successfully saved', 'data'=>$data));
			}else{
				return print json_encode(array('success' =>false,'status'=>500,'msg' =>'Error message: %s\n', $mysqli->error));
			}
		}*/
	}

	public static function reads(){
		/*$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$query1 ="select c.*,d.*,e.* from contestants c, departments d,events e where c.departmentid = d.departmentid and e.eventid = c.eventid";
			$result1 = $mysqli->query($query1);
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			print json_encode(array('success' =>true,'status'=>200,'childs' =>$data));
		}*/
	}

	public static function read(){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    return print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		}else{
			$arr = explode('-',$id);
			$userid = $arr[0];
			$eventid = $arr[1];

			?>
			<script type="text/javascript">
				console.log('hello');
			</script>
			<?php

			$query1 ="SELECT A.*,IF(A.hasScore,'true','false') AS IsDone FROM (SELECT c.contestantid,c.name,c.eventid,c.gender,d.departmentid,d.departmentname,d.departmentdesc,
				(SELECT DISTINCT s.score FROM scores s WHERE s.eventid = c.eventid AND s.contestantid = c.contestantid AND s.userid=$userid LIMIT 1) AS hasScore
				FROM contestants c INNER JOIN departments d ON c.departmentid = d.departmentid WHERE c.eventid=$eventid and c.contestanttype = 'qualified') AS A "; // and c.eventid=$id previously deleted
				
			$result1 = $mysqli->query($query1);
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			print json_encode(array('success' =>true,'status'=>200,'childs' =>$data));
		}
	}

	public static function update($id,$data){
		/*$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$contestantname = $mysqli->real_escape_string($data['contestantname']);
			$departmentname = $mysqli->real_escape_string($data['departmentname']);
			$eventname = $mysqli->real_escape_string($data['eventname']);
			$contestantid = $mysqli->real_escape_string($data['contestantid']);
			
			if ($stmt = $mysqli->prepare('update contestants set name=?,eventid=(select eventid from events where eventname=? limit 1),departmentid=(select departmentid from departments where departmentname=? limit 1) where contestantid = ?')){
				$stmt->bind_param('ssss', $contestantname,$eventname,$departmentname,$contestantid);
				$stmt->execute();
				return print json_encode(array('success' =>true,'status'=>200,'msg' =>'Record successfully saved', 'data'=>$data));
			}else{
				return print json_encode(array('success' =>false,'status'=>500,'msg' =>'Error message: %s\n', $mysqli->error));
			} 
		}*/
	}

	public static function delete($id){
		/*$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if($stmt = $mysqli->prepare('DELETE FROM contestants WHERE contestantid =?')){
			$stmt->bind_param('s', $id);
			$stmt->execute();
			$stmt->close();
			print json_encode(array('success' =>true,'status'=>200,'msg' =>'Record successfully deleted'));
		}else{
			print json_encode(array('success' =>false,'status'=>200,'msg' =>'Error message: %s\n', $mysqli->error));
		}*/
	}
}
?>
