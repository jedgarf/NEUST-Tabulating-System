<?php
require_once '../../server/connection.php';

class ScoreModel {

	function __construct(){
    }

	public static function create($data){
		$config= new Config();

		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			session_start();
			$usid = $_SESSION['user'];

			?>
			<script type="text/javascript">
				console.log("<?php echo 'Userid: '; ?>");
			</script>
			<?php

			$contestantid = $mysqli->real_escape_string($data['contestantid']);
			$criteriaid = $mysqli->real_escape_string($data['criteriaid']);
			$logic = false;

			$result = $mysqli->query("select * from scores where userid = $usid and contestantid = $contestantid and criteriaid = $criteriaid");

			if ($result->num_rows == 0) {
				$logic = true;
			}


		if ($logic == true) {	

			$scoring = $mysqli->real_escape_string($data['score']);
			$judgeid = $_SESSION['user'];
			$eventid = $mysqli->real_escape_string($data['eventid']);

			$mysqli->query("INSERT INTO scores (eventid,userid,criteriaid,score,contestantid) VALUES ($eventid,$judgeid,$criteriaid,$scoring,$contestantid)");
			/*return print json_encode(array('success' =>true,'status'=>200,'msg' =>'Record successfully saved', 'data'=>$data));*/
			return print json_encode('Score is Successfully Submitted!');

		}else{
			return print json_encode('Error message: This Criteria is Already Scored!');
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
			$query1 ="SELECT c.departmentname as country, sum(a.score) as visits, '#8A0CCF' as color
						FROM scores a,contestants b, departments c, criteria d
						where a.contestantid = b.contestantid
						and b.departmentid = c.departmentid
						and a.criteriaid = d.criteriaid
						group by departmentname
						order by country asc";
			$result1 = $mysqli->query($query1);
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			//print json_encode(array('success' =>true,'status'=>200,'childs' =>$data));
			print json_encode(array('data' =>$data));
		}
	}

	public static function detail($id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    return print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		}else{
			$query1 ="select * from criteria where eventid=$id";
			$result1 = $mysqli->query($query1);
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			print json_encode(array('success' =>true,'status'=>200,'childs' =>$data));
		}
	}

	public static function update($data){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{

			$criteriaid = $mysqli->real_escape_string($data['criteriaid']);
			$contestantid = $mysqli->real_escape_string($data['contestantid']);
			$scoring = $mysqli->real_escape_string($data['score']);
			$judgeid = $mysqli->real_escape_string($data['judgeid']);
			$eventid = $mysqli->real_escape_string($data['eventid']);

			$sql = "UPDATE scores SET score=$scoring WHERE (eventid=$eventid AND judgeid=$judgeid AND criteriaid=$criteriaid AND contestantid=$contestantid)";
			$result = $mysqli->query($sql);
			if ($result) {
				return print json_encode(array('success' =>true,'status'=>200,'msg' =>'Record successfully updated'));
			}else{
				return print json_encode(array('success' =>false,'status'=>400,'msg' =>'Error message: %s\n', $mysqli->error));
			}
		}
	}
}
?>
