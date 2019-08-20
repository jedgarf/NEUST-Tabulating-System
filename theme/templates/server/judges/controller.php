<?php
include('../../server/judges/model.php');

class JudgesCtrl {
	
	public static function create($data){
		if(isset($data['judgefname']) && empty($data['judgefname'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'First Name is required'));
		}
		if(isset($data['judgemname']) && empty($data['judgemname'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Middle Name is required'));
		}
		if(isset($data['judgelname']) && empty($data['judgelname'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Last Name is required'));
		}
		if(isset($data['judgeuname']) && empty($data['judgeuname'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Username is required'));
		}
		if(isset($data['judgepword']) && empty($data['judgepword'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Password is required'));
		}
		if(isset($data['eventid']) && empty($data['eventid'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Event is required'));
		}
		if(isset($data['gender']) && empty($data['gender'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'gender is required'),JSON_PRETTY_PRINT);
		}
		JudgesModel::create($data);
	}

	public static function read(){
		JudgesModel::read();
	}

	public static function detail($id){
		JudgesModel::detail($id);
	}

	public static function update($id,$data){
		if(isset($data['judgefname']) && empty($data['judgefname'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'First Name is required'));
		}
		if(isset($data['judgemname']) && empty($data['judgemname'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Middle Name is required'));
		}
		if(isset($data['judgelname']) && empty($data['judgelname'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Last Name is required'));
		}
		if(isset($data['judgeuname']) && empty($data['judgeuname'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Username is required'));
		}
		if(isset($data['judgepword']) && empty($data['judgepword'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Password is required'));
		}
		if(isset($data['judgeid']) && empty($data['judgeid'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Id is required'));
		}
		if(isset($data['judgegender']) && empty($data['judgegender'])){
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'gender is required'),JSON_PRETTY_PRINT);
		}
		JudgesModel::update($id,$data);
	}

	public static function delete($id){
		JudgesModel::delete($id);
	}
}

?>